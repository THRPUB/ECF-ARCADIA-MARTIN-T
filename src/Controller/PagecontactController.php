<?php

namespace App\Controller;

use App\Entity\Pagecontact;
use App\Form\PagecontactType;
use App\Repository\PagecontactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class PagecontactController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/pagecontacts",
     *     summary="Liste des prises de contact",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des prises de contact",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="Nom", type="string"),
     *                 @OA\Property(property="Email", type="string"),
     *                 @OA\Property(property="Message", type="string")
     *             )
     *         )
     *     )
     * )
     */
    #[Route('/api/pagecontacts', name: 'pagecontact_list', methods: ['GET'])]
    public function index(PagecontactRepository $pagecontactRepository): JsonResponse
    {
        $pagecontacts = $pagecontactRepository->findAll();
        return $this->json($pagecontacts);
    }

    /**
     * @OA\Post(
     *     path="/api/pagecontacts",
     *     summary="Créer une nouvelle prise de contact",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de la prise de contact à créer",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="Nom", type="string"),
     *             @OA\Property(property="Email", type="string"),
     *             @OA\Property(property="Message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Prise de contact créée avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="Nom", type="string"),
     *             @OA\Property(property="Email", type="string"),
     *             @OA\Property(property="Message", type="string")
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
    #[Route('/api/pagecontacts', name: 'pagecontact_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $pagecontact = new Pagecontact();
        $form = $this->createForm(PagecontactType::class, $pagecontact);
        $form->submit($data);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pagecontact);
            $entityManager->flush();

            return JsonResponse::create($pagecontact, Response::HTTP_CREATED);
        }

        return JsonResponse::create(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @OA\Delete(
     *     path="/api/pagecontacts/{id}",
     *     summary="Supprimer une prise de contact",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la prise de contact à supprimer",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Prise de contact supprimée avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Prise de contact non trouvée",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Prise de contact not found")
     *         )
     *     )
     * )
     */
    #[Route('/api/pagecontacts/{id}', name: 'pagecontact_delete', methods: ['DELETE'])]
    public function delete(Pagecontact $pagecontact): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($pagecontact);
        $entityManager->flush();

        return JsonResponse::create([], Response::HTTP_NO_CONTENT);
    }
}
