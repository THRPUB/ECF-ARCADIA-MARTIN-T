<?php

namespace App\Controller;

use App\Entity\AvisHabitats;
use App\Form\AvisHabitatsType;
use App\Repository\AvisHabitatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class AvisHabitatsController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/avis-habitats",
     *     summary="Liste des avis habitats",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des avis habitats",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="nomveterinaire", type="string"),
     *                 @OA\Property(property="nomhabitat", type="string"),
     *                 @OA\Property(property="avis", type="string")
     *             )
     *         )
     *     )
     * )
     * @Route("/api/avis-habitats", name="avis_habitats_list", methods={"GET"})
     */
    public function index(AvisHabitatsRepository $avisRepository): JsonResponse
    {
        $avisHabitats = $avisRepository->findAll();
        return $this->json($avisHabitats);
    }

    /**
     * @OA\Post(
     *     path="/api/avis-habitats",
     *     summary="Créer un nouvel avis habitat",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de l'avis habitat à créer",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="nomveterinaire", type="string"),
     *             @OA\Property(property="nomhabitat", type="string"),
     *             @OA\Property(property="avis", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Avis habitat créé avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="nomveterinaire", type="string"),
     *             @OA\Property(property="nomhabitat", type="string"),
     *             @OA\Property(property="avis", type="string")
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
     * @Route("/api/avis-habitats", name="avis_habitats_create", methods={"POST"})
     */
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $avisHabitats = new AvisHabitats();
        $form = $this->createForm(AvisHabitatsType::class, $avisHabitats);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avisHabitats);
            $entityManager->flush();

            return $this->json($avisHabitats, Response::HTTP_CREATED);
        }

        return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Delete(
     *     path="/api/avis-habitats/{id}",
     *     summary="Supprimer un avis habitat",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'avis habitat à supprimer",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Avis habitat supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Avis habitat non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Avis habitat not found")
     *         )
     *     )
     * )
     * @Route("/api/avis-habitats/{id}", name="avis_habitats_delete", methods={"DELETE"})
     */
    public function delete(AvisHabitats $avisHabitats): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($avisHabitats);
        $entityManager->flush();

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
