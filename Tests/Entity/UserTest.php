<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * Teste les méthodes de getter et setter de la classe User.
     */
    public function testGettersAndSetters()
    {
        $user = new User();

        // Teste setId et getId
        $user->setId(1);
        $this->assertEquals(1, $user->getId());

        // Teste setEmail et getEmail
        $user->setEmail('test@example.com');
        $this->assertEquals('test@example.com', $user->getEmail());

        // Teste setUsername et getUsername (alias pour getEmail)
        $this->assertEquals('test@example.com', $user->getUsername());

        // Teste setRoles et getRoles
        $user->setRoles(['ROLE_ADMIN']);
        $this->assertEquals(['ROLE_ADMIN', 'ROLE_USER'], $user->getRoles());

        // Teste setPassword et getPassword
        $user->setPassword('password123');
        $this->assertEquals('password123', $user->getPassword());

        // Teste setCreatedAt et getCreatedAt
        $createdAt = new \DateTimeImmutable('2022-01-01');
        $user->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $user->getCreatedAt());

        // Teste setUpdatedAt et getUpdatedAt
        $updatedAt = new \DateTimeImmutable('2022-01-02');
        $user->setUpdatedAt($updatedAt);
        $this->assertEquals($updatedAt, $user->getUpdatedAt());

        // Teste setApiToken et getApiToken
        $user->setApiToken('api_token_123');
        $this->assertEquals('api_token_123', $user->getApiToken());
    }

    /**
     * Teste le constructeur de la classe User.
     */
    public function testConstructor()
    {
        // Teste que apiToken est défini lors de la construction
        $user = new User();
        $this->assertNotNull($user->getApiToken());
    }

    /**
     * Teste la méthode eraseCredentials.
     */
    public function testEraseCredentials()
    {
        // Teste la méthode eraseCredentials
        $user = new User();
        $user->setPassword('password123');
        $user->eraseCredentials();

        // Dans cet exemple, eraseCredentials ne fait rien, donc le mot de passe devrait toujours être présent
        $this->assertEquals('password123', $user->getPassword());
    }
}
