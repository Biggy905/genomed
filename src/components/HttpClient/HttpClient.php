<?php

declare(strict_types=1);

namespace app\components\HttpClient;

use Symfony\Component\HttpClient\HttpClient as SymfonyClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class HttpClient
{
    /**
     * @throws TransportExceptionInterface
     */
    public function exec(
        string $url
    ): array {
        $client = SymfonyClient::create();
        $response = $client->request(
            'GET',
            $url
        );

        try {
            return [
                'code' => $response->getStatusCode(),
                'body' => $response->getContent(false),
            ];
        } catch (
            ClientExceptionInterface
            | RedirectionExceptionInterface
            | ServerExceptionInterface
            | TransportExceptionInterface $e
        ) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }
}
