<?php

namespace App\Controller;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

#[Route('/api', name: 'app_api_')]
class SecurityController extends AbstractController
{
    public function __construct(private EntityManagerInterface $manager, private SerializerInterface $serializer)
    {
    }

    #[Route('/registration', name: 'registration', methods: 'POST')]
    /** 
     * @OA\Post(
     *     path="/api/registration",
     *     summary="Inscription d'un nouvel utilisateur",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de l'utilisateur à inscrire",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="email", type="string", example="adresse@email.com"),
     *             @OA\Property(property="password", type="string", example="Mot de passe"),
     *             @OA\Property(property="role", type="string", example="ROLE_EMPLOYE")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Utilisateur inscrit avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="user", type="string", example="Nom d'utilisateur"),
     *             @OA\Property(property="apiToken", type="string", example="31a023e212f116124a36af14ea0c1c3806eb9378"),
     *             @OA\Property(property="roles", type="array", @OA\Items(type="string", example="ROLE_USER"))
     *         )
     *     )
     * )
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Vérifier si le champ 'role' est présent dans les données JSON
        $role = $data['role'] ?? null;

        // Vérifier si le rôle spécifié est autorisé, sinon attribuer par défaut 'ROLE_USER'
        $allowedRoles = ['ROLE_EMPLOYE', 'ROLE_ADMIN', 'ROLE_VETERINAIRE'];
        $userRole = in_array($role, $allowedRoles) ? $role : 'ROLE_USER';

        // Créer un nouvel utilisateur avec le rôle spécifié
        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword($passwordEncoder->encodePassword($user, $data['password']));
        $user->setRoles([$userRole]); // Définir le rôle
        $user->setCreatedAt(new DateTimeImmutable());

        $this->manager->persist($user);
        $this->manager->flush();
        
        return new JsonResponse(
            ['user'  => $user->getUserIdentifier(), 'apiToken' => $user->getApiToken(), 'roles' => $user->getRoles()],
            Response::HTTP_CREATED
        );
    }

    #[Route('/login', name: 'login', methods: 'POST')]
    /** 
     * @OA\Post(
     *     path="/api/login",
     *     summary="Connecter un utilisateur",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de l’utilisateur pour se connecter",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="username", type="string", example="adresse@email.com"),
     *             @OA\Property(property="password", type="string", example="Mot de passe")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Connexion réussie",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="user", type="string", example="Nom d'utilisateur"),
     *             @OA\Property(property="apiToken", type="string", example="31a023e212f116124a36af14ea0c1c3806eb9378"),
     *             @OA\Property(property="roles", type="array", @OA\Items(type="string", example="ROLE_USER"))
     *         )
     *     )
     * )
     */
    public function login(Request $request, UserPasswordEncoderInterface $passwordEncoder): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $usernameOrEmail = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        if (null === $usernameOrEmail || null === $password) {
            return new JsonResponse(['message' => 'Missing credentials'], Response::HTTP_UNAUTHORIZED);
        }

        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $usernameOrEmail]);

        if (!$user || !$passwordEncoder->isPasswordValid($user, $password)) {
            return new JsonResponse(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse([
            'user' => $user->getUserIdentifier(),
            'apiToken' => $user->getApiToken(),
            'roles' => $user->getRoles(),
        ]);
    }
}
