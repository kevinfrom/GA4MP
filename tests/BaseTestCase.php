<?php

namespace kevinfrom\GA4MP\Tests;

use Dotenv\Dotenv;
use kevinfrom\GA4MP\Http\Client;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    private Client $client;
    private string $client_id = 'test_client_id';

    protected function getClient(): Client
    {
        return $this->client;
    }

    protected function getClientId(): string
    {
        return $this->client_id;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::createImmutable(__DIR__ . '/..', '.env.testing');
        $dotenv->load();

        $this->client = new Client($_ENV['GA4_MP_API_SECRET'], $_ENV['GA4_MP_MEASUREMENT_ID']);
    }
}