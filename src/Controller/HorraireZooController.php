<?php

namespace App\Controller;

use App\Entity\HorraireZoo;
use App\Form\HorraireZooType;
use App\Repository\HorraireZooRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class HorraireZooController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/horraires",
     *     summary="Liste des horaires du zoo",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des horaires",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="jour", type="string"),
     *                 @OA\Property(property="heureOuverture", type="string"),
     *                 @OA\Property(property="heureFermeture", type="string")
     *             )
     *         )
     *     )
     * )
     */
    #[Route('/api/horraires', name: 'horraires_list', methods: ['GET'])]
    public function index(HorraireZooRepository $horraireZooRepository): Response
    {
        $horraires = $horraireZooRepository->findAll();

        return $this->json($horraires);
    }

    /**
     * @OA\Get(
     *     path="/api/horraires/{id}",
     *     summary="Afficher les détails d'un horaire du zoo",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'horaire",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails de l'horaire",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="jour", type="string"),
     *             @OA\Property(property="heureOuverture", type="string"),
     *             @OA\Property(property="heureFermeture", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Horaire non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Horaire not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/horraires/{id}', name: 'horraires_show', methods: ['GET'])]
    public function show(HorraireZoo $horaireZoo): Response
    {
        return $this->json($horaireZoo);
    }

    /**
     * @OA\Post(
     *     path="/api/horraires",
     *     summary="Créer un nouvel horaire pour le zoo",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de l'horaire à créer",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="jour", type="string"),
     *             @OA\Property(property="heureOuverture", type="string"),
     *             @OA\Property(property="heureFermeture", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Horaire créé avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="jour", type="string"),
     *             @OA\Property(property="heureOuverture", type="string"),
     *             @OA\Property(property="heureFermeture", type="string")
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
    #[Route('/api/horraires', name: 'horraires_create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $horaireZoo = new HorraireZoo();
        $form = $this->createForm(HorraireZooType::class, $horaireZoo);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($horaireZoo);
            $entityManager->flush();

            return $this->json($horaireZoo, Response::HTTP_CREATED);
        }

        return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Put(
     *     path="/api/horraires/{id}",
     *     summary="Modifier un horaire du zoo",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'horaire à modifier",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Nouvelles données de l'horaire",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="jour", type="string"),
     *             @OA\Property(property="heureOuverture", type="string"),
     *             @OA\Property(property="heureFermeture", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Horaire modifié avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="jour", type="string"),
     *             @OA\Property(property="heureOuverture", type="string"),
     *             @OA\Property(property="heureFermeture", type="string")
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
     *         description="Horaire non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Horaire not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/horraires/{id}', name: 'horraires_update', methods: ['PUT'])]
    public function update(Request $request, HorraireZoo $horaireZoo): Response
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(HorraireZooType::class, $horaireZoo);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->json($horaireZoo);
        }

        return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Delete(
     *     path="/api/horraires/{id}",
     *     summary="Supprimer un horaire du zoo",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'horaire à supprimer",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Horaire supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Horaire non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Horaire not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/horraires/{id}', name: 'horraires_delete', methods: ['DELETE'])]
    public function delete(HorraireZoo $horaireZoo): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($horaireZoo);
        $entityManager->flush();

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
