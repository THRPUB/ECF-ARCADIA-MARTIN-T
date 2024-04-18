<?php

namespace App\Controller;

use App\Entity\Services;
use App\Form\ServicesType;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class ServicesController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/services",
     *     summary="Liste des services",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des services",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="nom", type="string"),
     *                 @OA\Property(property="Description", type="string")
     *             )
     *         )
     *     )
     * )
     */
    #[Route('/api/services', name: 'services_list', methods: ['GET'])]
    public function index(ServicesRepository $servicesRepository): Response
    {
        $services = $servicesRepository->findAll();

        return $this->json($services);
    }

    /**
     * @OA\Get(
     *     path="/api/services/{id}",
     *     summary="Afficher les détails d'un service",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID du service",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails du service",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="Description", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Service non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Service not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/services/{id}', name: 'services_show', methods: ['GET'])]
    public function show(Services $service): Response
    {
        return $this->json($service);
    }

    /**
     * @OA\Post(
     *     path="/api/services",
     *     summary="Créer un nouveau service",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données du service à créer",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="Description", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Service créé avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="Description", type="string")
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
    #[Route('/api/services', name: 'services_create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $service = new Services();
        $form = $this->createForm(ServicesType::class, $service);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->json($service, Response::HTTP_CREATED);
        }

        return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Put(
     *     path="/api/services/{id}",
     *     summary="Modifier les détails d'un service",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID du service",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Nouvelles données du service",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="Description", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service modifié avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="Description", type="string")
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
     *         description="Service non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Service not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/services/{id}', name: 'services_update', methods: ['PUT'])]
    public function update(Request $request, Services $service): Response
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(ServicesType::class, $service);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->json($service);
        }

        return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Delete(
     *     path="/api/services/{id}",
     *     summary="Supprimer un service",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID du service à supprimer",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Service supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Service non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Service not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/services/{id}', name: 'services_delete', methods: ['DELETE'])]
    public function delete(Services $service): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($service);
        $entityManager->flush();

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
