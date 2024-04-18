<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class AvisController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/avis",
     *     summary="Liste des avis",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des avis",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="Avis_id", type="integer"),
     *                 @OA\Property(property="Pseudo", type="string"),
     *                 @OA\Property(property="Avis", type="string"),
     *                 @OA\Property(property="validation", type="boolean")
     *             )
     *         )
     *     )
     * )
     */
    #[Route('/api/avis', name: 'avis_list', methods: ['GET'])]
    public function index(AvisRepository $avisRepository): JsonResponse
    {
        $avis = $avisRepository->findAll();
        return $this->json($avis);
    }

    /**
     * @OA\Get(
     *     path="/api/avis/{id}",
     *     summary="Afficher les détails d'un avis",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'avis",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails de l'avis",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="Avis_id", type="integer"),
     *             @OA\Property(property="Pseudo", type="string"),
     *             @OA\Property(property="Avis", type="string"),
     *             @OA\Property(property="validation", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Avis non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Avis not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/avis/{id}', name: 'avis_show', methods: ['GET'])]
    public function show(Avis $avis): Response
    {
        return $this->json($avis, Response::HTTP_OK, [], ['groups' => 'avis']);
    }

    /**
     * @OA\Post(
     *     path="/api/avis",
     *     summary="Créer un nouvel avis",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de l'avis à créer",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="Pseudo", type="string"),
     *             @OA\Property(property="Avis", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Avis créé avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="Avis_id", type="integer"),
     *             @OA\Property(property="Pseudo", type="string"),
     *             @OA\Property(property="Avis", type="string"),
     *             @OA\Property(property="validation", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Données invalides",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Invalid data")
     *         )
     *     )
     * )
     */
    #[Route('/api/avis', name: 'avis_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);
        $form->submit($data);

        if ($form->isValid()) {
            $avis->setValidation(false); // Définition de la valeur par défaut
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avis);
            $entityManager->flush();

            return JsonResponse::create($avis, Response::HTTP_CREATED);
        }

        return JsonResponse::create(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Put(
     *     path="/api/avis/{id}",
     *     summary="Modifier les détails d'un avis",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'avis",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Nouvelles données de l'avis",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="Pseudo", type="string"),
     *             @OA\Property(property="Avis", type="string"),
     *             @OA\Property(property="validation", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Avis modifié avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="Avis_id", type="integer"),
     *             @OA\Property(property="Pseudo", type="string"),
     *             @OA\Property(property="Avis", type="string"),
     *             @OA\Property(property="validation", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Données invalides",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Invalid data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Avis non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Avis not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/avis/{id}', name: 'avis_update', methods: ['PUT'])]
    public function update(Request $request, Avis $avis): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(AvisType::class, $avis);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return JsonResponse::create($avis, Response::HTTP_OK);
        }

        return JsonResponse::create(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Delete(
     *     path="/api/avis/{id}",
     *     summary="Supprimer un avis",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'avis à supprimer",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Avis supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Avis non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Avis not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/avis/{id}', name: 'avis_delete', methods: ['DELETE'])]
    public function delete(Avis $avis): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($avis);
        $entityManager->flush();

        return JsonResponse::create([], Response::HTTP_NO_CONTENT);
    }
}
