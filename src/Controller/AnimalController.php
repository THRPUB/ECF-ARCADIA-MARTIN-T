<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class AnimalController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/animals",
     *     summary="Liste des animaux",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des animaux",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="animal_id", type="integer"),
     *                 @OA\Property(property="prenom", type="string"),
     *                 @OA\Property(property="race", type="string"),
     *                 @OA\Property(property="image_url", type="string"),
     *                 @OA\Property(property="habitat", type="integer", nullable=true),
     *             )
     *         )
     *     )
     * )
     */
    #[Route('/api/animals', name: 'animal_list', methods: ['GET'])]
    public function index(AnimalRepository $animalRepository): JsonResponse
    {
        $animals = $animalRepository->findAll();

        $data = [];

        foreach ($animals as $animal) {
            $data[] = [
                'animal_id' => $animal->getAnimalId(),
                'prenom' => $animal->getPrenom(),
                'race' => $animal->getRace(),
                'image_url' => $animal->getImageUrl(),
                'habitat' => $animal->getHabitat() ? $animal->getHabitat()->getHabitatId() : null,
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/api/animals/{id}",
     *     summary="Afficher les détails d'un animal",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'animal",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails de l'animal",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="animal_id", type="integer"),
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="race", type="string"),
     *             @OA\Property(property="image_url", type="string"),
     *             @OA\Property(property="habitat", type="integer", nullable=true),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Animal non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Animal not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/animals/{id}', name: 'animal_show', methods: ['GET'])]
    public function show(Animal $animal): JsonResponse
    {
        $data = [
            'animal_id' => $animal->getAnimalId(),
            'prenom' => $animal->getPrenom(),
            'race' => $animal->getRace(),
            'image_url' => $animal->getImageUrl(),
            'habitat' => $animal->getHabitat() ? $animal->getHabitat()->getHabitatId() : null,
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/animals",
     *     summary="Créer un nouvel animal",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de l'animal à créer",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="race", type="string", nullable=true),
     *             @OA\Property(property="image_url", type="string", nullable=true),
     *             @OA\Property(property="habitat", type="integer", nullable=true),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Animal créé avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="animal_id", type="integer"),
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="race", type="string", nullable=true),
     *             @OA\Property(property="image_url", type="string", nullable=true),
     *             @OA\Property(property="habitat", type="integer", nullable=true),
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Données invalides",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="errors", type="array", @OA\Items(type="string"))
     *         )
     *     )
     * )
     */
    #[Route('/api/animals', name: 'animal_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse(['error' => 'Invalid JSON format'], Response::HTTP_BAD_REQUEST);
        }

        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($animal);
            $entityManager->flush();

            $responseData = [
                'animal_id' => $animal->getAnimalId(),
                'prenom' => $animal->getPrenom(),
                'race' => $animal->getRace(),
                'image_url' => $animal->getImageUrl(),
                'habitat' => $animal->getHabitat() ? $animal->getHabitat()->getHabitatId() : null,
            ];

            return new JsonResponse($responseData, Response::HTTP_CREATED);
        }

        $errors = [];
        foreach ($form->getErrors(true, true) as $error) {
            $errors[$error->getOrigin()->getName()][] = $error->getMessage();
        }

        return new JsonResponse(['errors' => $errors], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Put(
     *     path="/api/animals/{id}",
     *     summary="Modifier les détails d'un animal",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'animal",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Nouvelles données de l'animal",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="race", type="string", nullable=true),
     *             @OA\Property(property="image_url", type="string", nullable=true),
     *             @OA\Property(property="habitat", type="integer", nullable=true),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Animal modifié avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="animal_id", type="integer"),
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="race", type="string", nullable=true),
     *             @OA\Property(property="image_url", type="string", nullable=true),
     *             @OA\Property(property="habitat", type="integer", nullable=true),
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Données invalides",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="errors", type="array", @OA\Items(type="string"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Animal non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Animal not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/animals/{id}', name: 'animal_update', methods: ['PUT'])]
    public function update(Request $request, Animal $animal): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse(['error' => 'Invalid JSON format'], Response::HTTP_BAD_REQUEST);
        }

        $form = $this->createForm(AnimalType::class, $animal);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $responseData = [
                'animal_id' => $animal->getAnimalId(),
                'prenom' => $animal->getPrenom(),
                'race' => $animal->getRace(),
                'image_url' => $animal->getImageUrl(),
                'habitat' => $animal->getHabitat() ? $animal->getHabitat()->getHabitatId() : null,
            ];

            return new JsonResponse($responseData);
        }

        $errors = [];
        foreach ($form->getErrors(true, true) as $error) {
            $errors[$error->getOrigin()->getName()][] = $error->getMessage();
        }

        return new JsonResponse(['errors' => $errors], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Delete(
     *     path="/api/animals/{id}",
     *     summary="Supprimer un animal",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'animal à supprimer",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Animal supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Animal non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Animal not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/animals/{id}', name: 'animal_delete', methods: ['DELETE'])]
    public function delete(Animal $animal): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($animal);
        $entityManager->flush();

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
