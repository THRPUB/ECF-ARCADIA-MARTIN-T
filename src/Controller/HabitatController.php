<?php

namespace App\Controller;

use App\Entity\Habitat;
use App\Form\HabitatType;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IgnoreCsrfProtection;

class HabitatController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/habitat",
     *     summary="Liste des habitats",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des habitats",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="nom", type="string"),
     *                 @OA\Property(property="description", type="string"),
     *                 @OA\Property(property="image_url", type="string")
     *             )
     *         )
     *     )
     * )
     */
    #[Route('/api/habitat', name: 'habitat_list', methods: ['GET'])]
    public function index(HabitatRepository $habitatRepository): Response
    {
        $habitats = $habitatRepository->findAll();

        return $this->json($habitats);
    }

    /**
     * @OA\Get(
     *     path="/api/habitat/{id}",
     *     summary="Afficher les détails d'un habitat",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'habitat",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails de l'habitat",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nom", type="string", example="Nom de l'habitat"),
     *             @OA\Property(property="description", type="string", example="Description de l'habitat"),
     *             @OA\Property(property="image_url", type="string", example="URL de l'image"),
     *             @OA\Property(property="createdAt", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Habitat non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Habitat not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/habitat/{id}', name: 'habitat_show', methods: ['GET'])]
    public function show(Habitat $habitat): Response
    {
        return $this->json($habitat);
    }

    /**
     * @OA\Post(
     *     path="/api/habitat",
     *     summary="Créer un nouvel habitat",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de l'habitat à créer",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="image_url", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Habitat créé avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="image_url", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Données invalides",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Invalid data"),
     *             @OA\Property(property="validation_errors", type="array", @OA\Items(type="string"))
     *         )
     *     )
     * )
     */
    #[IgnoreCsrfProtection]
    #[Route('/api/habitat', name: 'habitat_create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $habitat = new Habitat();
        $form = $this->createForm(HabitatType::class, $habitat);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($habitat);
            $entityManager->flush();

            return $this->json($habitat, Response::HTTP_CREATED);
        }

        $errors = [];
        foreach ($form->getErrors(true) as $error) {
            $errors[] = $error->getMessage();
        }

        return $this->json(['error' => 'Invalid data', 'validation_errors' => $errors], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Put(
     *     path="/api/habitat/{id}",
     *     summary="Modifier les détails d'un habitat",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'habitat",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Nouvelles données de l'habitat",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="image_url", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Habitat modifié avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="image_url", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Données invalides",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Invalid data"),
     *             @OA\Property(property="validation_errors", type="array", @OA\Items(type="string"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Habitat non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Habitat not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/habitat/{id}', name: 'habitat_update', methods: ['PUT'])]
    public function update(Request $request, Habitat $habitat): Response
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(HabitatType::class, $habitat);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->json($habitat);
        }

        $errors = [];
        foreach ($form->getErrors(true) as $error) {
            $errors[] = $error->getMessage();
        }

        return $this->json(['error' => 'Invalid data', 'validation_errors' => $errors], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Delete(
     *     path="/api/habitat/{id}",
     *     summary="Supprimer un habitat",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'habitat à supprimer",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Habitat supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Habitat non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Habitat not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/habitat/{id}', name: 'habitat_delete', methods: ['DELETE'])]
    public function delete(Habitat $habitat): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($habitat);
        $entityManager->flush();

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
