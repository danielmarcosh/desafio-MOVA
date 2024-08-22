<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ClientPokemonService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout'  => 2.0,
        ]);
    }

    public function getPokemonById(int $id)
    {
        try {
            $response = $this->client->request('GET', "pokemon/{$id}");

            // Verifique se a resposta foi bem-sucedida
            if ($response->getStatusCode() === 200) {
                // Decodifique o JSON e retorne os dados
                return json_decode($response->getBody()->getContents(), true);
            }

            return null;
        } catch (RequestException $e) {
            // Trate erros de requisição
            return ['error' => $e->getMessage()];
        }
    }
    public function getEffectEntriesById(int $id)
    {
        try {
            $response = $this->client->request('GET', "move/{$id}");

            // Verifique se a resposta foi bem-sucedida
            if ($response->getStatusCode() === 200) {
                // Decodifique o JSON e retorne os dados
                return json_decode($response->getBody()->getContents(), true);
            }

            return null;
        } catch (RequestException $e) {
            // Trate erros de requisição
            return ['error' => $e->getMessage()];
        }
    }
}
