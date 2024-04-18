<?php

namespace App\Controller;

use App\Entity\PassageEmploye;
use App\Form\PassageEmployeType;
use App\Repository\PassageEmployeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class PassageEmployeController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/passage-employe",
     *     summary="Liste des passages employés",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des passages employés",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="Passage_id", type="integer"),
     *                 @OA\Property(property="animal", type="integer"),
     *                 @OA\Property(property="Nourriture_apportee", type="string"),
     *                 @OA\Property(property="Grammage_de_la_nourriture", type="string"),
     *                 @OA\Property(property="Date_de_passage", type="string", format="date"),
     *                 @OA\Property(property="Heure_de_passage", type="string")
     *             )
     *         )
     *     )
     * )
     */
    #[Route('/api/passage-employe', name: 'passage_employe_list', methods: ['GET'])]
    public function index(PassageEmployeRepository $passageEmployeRepository): Response
    {
        $passagesEmployes = $passageEmployeRepository->findAll();

        return $this->json($passagesEmployes);
    }

    /**
     * @OA\Get(
     *     path="/api/passage-employe/{id}",
     *     summary="Afficher les détails d'un passage employé",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID du passage employé",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails du passage employé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="Passage_id", type="integer"),
     *             @OA\Property(property="animal", type="integer"),
     *             @OA\Property(property="Nourriture_apportee", type="string"),
     *             @OA\Property(property="Grammage_de_la_nourriture", type="string"),
     *             @OA\Property(property="Date_de_passage", type="string", format="date"),
     *             @OA\Property(property="Heure_de_passage", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Passage employé non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Passage employé not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/passage-employe/{id}', name: 'passage_employe_show', methods: ['GET'])]
    public function show(PassageEmploye $passageEmploye): Response
    {
        return $this->json($passageEmploye);
    }

    /**
     * @OA\Post(
     *     path="/api/passage-employe",
     *     summary="Créer un nouveau passage employé",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données du passage employé à créer",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="animal", type="integer"),
     *             @OA\Property(property="Nourriture_apportee", type="string"),
     *             @OA\Property(property="Grammage_de_la_nourriture", type="string"),
     *             @OA\Property(property="Date_de_passage", type="string", format="date"),
     *             @OA\Property(property="Heure_de_passage", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Passage employé créé avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="Passage_id", type="integer"),
     *             @OA\Property(property="animal", type="integer"),
     *             @OA\Property(property="Nourriture_apportee", type="string"),
     *             @OA\Property(property="Grammage_de_la_nourriture", type="string"),
     *             @OA\Property(property="Date_de_passage", type="string", format="date"),
     *             @OA\Property(property="Heure_de_passage", type="string")
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
    #[Route('/api/passage-employe', name: 'passage_employe_create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->json(['error' => 'Invalid JSON format'], Response::HTTP_BAD_REQUEST);
        }

        $passageEmploye = new PassageEmploye();
        $form = $this->createForm(PassageEmployeType::class, $passageEmploye);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($passageEmploye);
            $entityManager->flush();

            return $this->json($passageEmploye, Response::HTTP_CREATED);
        }

        $errors = [];
        foreach ($form->getErrors(true, true) as $error) {
            $errors[$error->getOrigin()->getName()][] = $error->getMessage();
        }

        return $this->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Put(
     *     path="/api/passage-employe/{id}",
     *     summary="Modifier les détails d'un passage employé",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID du passage employé",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Nouvelles données du passage employé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="animal", type="integer"),
     *             @OA\Property(property="Nourriture_apportee", type="string"),
     *             @OA\Property(property="Grammage_de_la_nourriture", type="string"),
     *             @OA\Property(property="Date_de_passage", type="string", format="date"),
     *             @OA\Property(property="Heure_de_passage", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Passage employé modifié avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="Passage_id", type="integer"),
     *             @OA\Property(property="animal", type="integer"),
     *             @OA\Property(property="Nourriture_apportee", type="string"),
     *             @OA\Property(property="Grammage_de_la_nourriture", type="string"),
     *             @OA\Property(property="Date_de_passage", type="string", format="date"),
     *             @OA\Property(property="Heure_de_passage", type="string")
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
     *         description="Passage employé non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Passage employé not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/passage-employe/{id}', name: 'passage_employe_update', methods: ['PUT'])]
    public function update(Request $request, PassageEmploye $passageEmploye): Response
    {
        $data = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->json(['error' => 'Invalid JSON format'], Response::HTTP_BAD_REQUEST);
        }

        $form = $this->createForm(PassageEmployeType::class, $passageEmploye);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->json($passageEmploye);
        }

        $errors = [];
        foreach ($form->getErrors(true, true) as $error) {
            $errors[$error->getOrigin()->getName()][] = $error->getMessage();
        }

        return $this->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Delete(
     *     path="/api/passage-employe/{id}",
     *     summary="Supprimer un passage employé",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID du passage employé à supprimer",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Passage employé supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Passage employé non trouvé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Passage employé not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/passage-employe/{id}', name: 'passage_employe_delete', methods: ['DELETE'])]
    public function delete(PassageEmploye $passageEmploye): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($passageEmploye);
        $entityManager->flush();

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
