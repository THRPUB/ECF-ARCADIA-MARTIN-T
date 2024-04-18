<?php

namespace App\Controller;

use App\Entity\VisiteVeterinaire;
use App\Form\VisiteVeterinaireType;
use App\Repository\VisiteVeterinaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class VisiteVeterinaireController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/visite-veterinaire",
     *     summary="Liste des visites vétérinaires",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des visites vétérinaires",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="visite_id", type="integer"),
     *                 @OA\Property(property="animal", type="integer"),
     *                 @OA\Property(property="etat_animal", type="string"),
     *                 @OA\Property(property="nourriture_proposee", type="string"),
     *                 @OA\Property(property="grammage_nourriture", type="string"),
     *                 @OA\Property(property="date_passage", type="string", format="date"),
     *                 @OA\Property(property="detail_etat_animal", type="string"),
     *                 @OA\Property(property="Nom_veterinaire", type="string")
     *             )
     *         )
     *     )
     * )
     */
    #[Route('/api/visite-veterinaire', name: 'visite_veterinaire_list', methods: ['GET'])]
    public function index(VisiteVeterinaireRepository $visiteVeterinaireRepository): Response
    {
        $visitesVeterinaires = $visiteVeterinaireRepository->findAll();

        return $this->json($visitesVeterinaires);
    }

    /**
     * @OA\Get(
     *     path="/api/visite-veterinaire/{id}",
     *     summary="Afficher les détails d'une visite vétérinaire",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la visite vétérinaire",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails de la visite vétérinaire",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="visite_id", type="integer"),
     *             @OA\Property(property="animal", type="integer"),
     *             @OA\Property(property="etat_animal", type="string"),
     *             @OA\Property(property="nourriture_proposee", type="string"),
     *             @OA\Property(property="grammage_nourriture", type="string"),
     *             @OA\Property(property="date_passage", type="string", format="date"),
     *             @OA\Property(property="detail_etat_animal", type="string"),
     *             @OA\Property(property="Nom_veterinaire", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Visite vétérinaire non trouvée",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Visite vétérinaire not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/visite-veterinaire/{id}', name: 'visite_veterinaire_show', methods: ['GET'])]
    public function show(VisiteVeterinaire $visiteVeterinaire): Response
    {
        return $this->json($visiteVeterinaire);
    }

    /**
     * @OA\Post(
     *     path="/api/visite-veterinaire",
     *     summary="Créer une nouvelle visite vétérinaire",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de la visite vétérinaire à créer",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="animal", type="integer"),
     *             @OA\Property(property="etat_animal", type="string"),
     *             @OA\Property(property="nourriture_proposee", type="string"),
     *             @OA\Property(property="grammage_nourriture", type="string"),
     *             @OA\Property(property="date_passage", type="string", format="date"),
     *             @OA\Property(property="detail_etat_animal", type="string"),
     *             @OA\Property(property="Nom_veterinaire", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Visite vétérinaire créée avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="visite_id", type="integer"),
     *             @OA\Property(property="animal", type="integer"),
     *             @OA\Property(property="etat_animal", type="string"),
     *             @OA\Property(property="nourriture_proposee", type="string"),
     *             @OA\Property(property="grammage_nourriture", type="string"),
     *             @OA\Property(property="date_passage", type="string", format="date"),
     *             @OA\Property(property="detail_etat_animal", type="string"),
     *             @OA\Property(property="Nom_veterinaire", type="string")
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
    #[Route('/api/visite-veterinaire', name: 'visite_veterinaire_create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->json(['error' => 'Invalid JSON format'], Response::HTTP_BAD_REQUEST);
        }

        $visiteVeterinaire = new VisiteVeterinaire();
        $form = $this->createForm(VisiteVeterinaireType::class, $visiteVeterinaire);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($visiteVeterinaire);
            $entityManager->flush();

            return $this->json($visiteVeterinaire, Response::HTTP_CREATED);
        }

        $errors = [];
        foreach ($form->getErrors(true, true) as $error) {
            $errors[$error->getOrigin()->getName()][] = $error->getMessage();
        }

        return $this->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Put(
     *     path="/api/visite-veterinaire/{id}",
     *     summary="Modifier les détails d'une visite vétérinaire",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la visite vétérinaire",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Nouvelles données de la visite vétérinaire",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="animal", type="integer"),
     *             @OA\Property(property="etat_animal", type="string"),
     *             @OA\Property(property="nourriture_proposee", type="string"),
     *             @OA\Property(property="grammage_nourriture", type="string"),
     *             @OA\Property(property="date_passage", type="string", format="date"),
     *             @OA\Property(property="detail_etat_animal", type="string"),
     *             @OA\Property(property="Nom_veterinaire", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Visite vétérinaire modifiée avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="visite_id", type="integer"),
     *             @OA\Property(property="animal", type="integer"),
     *             @OA\Property(property="etat_animal", type="string"),
     *             @OA\Property(property="nourriture_proposee", type="string"),
     *             @OA\Property(property="grammage_nourriture", type="string"),
     *             @OA\Property(property="date_passage", type="string", format="date"),
     *             @OA\Property(property="detail_etat_animal", type="string"),
     *             @OA\Property(property="Nom_veterinaire", type="string")
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
     *         description="Visite vétérinaire non trouvée",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Visite vétérinaire not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/visite-veterinaire/{id}', name: 'visite_veterinaire_update', methods: ['PUT'])]
    public function update(Request $request, VisiteVeterinaire $visiteVeterinaire): Response
    {
        $data = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->json(['error' => 'Invalid JSON format'], Response::HTTP_BAD_REQUEST);
        }

        $form = $this->createForm(VisiteVeterinaireType::class, $visiteVeterinaire);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->json($visiteVeterinaire);
        }

        $errors = [];
        foreach ($form->getErrors(true, true) as $error) {
            $errors[$error->getOrigin()->getName()][] = $error->getMessage();
        }

        return $this->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Delete(
     *     path="/api/visite-veterinaire/{id}",
     *     summary="Supprimer une visite vétérinaire",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la visite vétérinaire à supprimer",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Visite vétérinaire supprimée avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Visite vétérinaire non trouvée",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Visite vétérinaire not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/visite-veterinaire/{id}', name: 'visite_veterinaire_delete', methods: ['DELETE'])]
    public function delete(VisiteVeterinaire $visiteVeterinaire): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($visiteVeterinaire);
        $entityManager->flush();

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
