<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testRegistration()
    {
        $client = static::createPantherClient();

        // Simuler une requête POST avec les données nécessaires
        $client->request('POST', '/api/registration', [], [], [], json_encode([
            'email' => 'test@example.com',
            'password' => 'password123',
        ]));

        // Vérifier que la réponse a un statut HTTP 201 (Created)
        $this->assertSame(201, $client->getResponse()->getStatusCode());

        // Vérifier que la réponse est au format JSON
        $this->assertJson($client->getResponse()->getContent());

        // Décoder la réponse JSON
        $responseData = json_decode($client->getResponse()->getContent(), true);

        // Vérifier que les clés attendues sont présentes dans la réponse
        $this->assertArrayHasKey('user', $responseData);
        $this->assertArrayHasKey('apiToken', $responseData);
        $this->assertArrayHasKey('roles', $responseData);
    }

    public function testLogin()
    {
        $client = static::createPantherClient();

        // Simuler une requête POST avec les données nécessaires
        $client->request('POST', '/api/login', [], [], [], json_encode([
            'username' => 'test@example.com',
            'password' => 'password123',
        ]));

        // Vérifier que la réponse a un statut HTTP 200 (OK)
        $this->assertSame(200, $client->getResponse()->getStatusCode());

        // Vérifier que la réponse est au format JSON
        $this->assertJson($client->getResponse()->getContent());

        // Décoder la réponse JSON
        $responseData = json_decode($client->getResponse()->getContent(), true);

        // Vérifier que les clés attendues sont présentes dans la réponse
        $this->assertArrayHasKey('user', $responseData);
        $this->assertArrayHasKey('apiToken', $responseData);
        $this->assertArrayHasKey('roles', $responseData);
    }
}
