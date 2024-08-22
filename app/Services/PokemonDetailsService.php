<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\PokemonDetailsServiceInterface;
use App\DTO\PokemonData;

class PokemonDetailsService implements PokemonDetailsServiceInterface
{
    private ClientPokemonService $clientPokemonService;

    public function __construct(ClientPokemonService $clientPokemonService)
    {
        $this->clientPokemonService = $clientPokemonService;
    }

    public function getPokemonDetails(int $id): PokemonData
    {
        // Realize as requisições
        try {
            $responsePokemonDetail = $this->clientPokemonService->getPokemonById($id);

            // Valide e defina os dados do Pokémon
            $name = $responsePokemonDetail['name'] ?? 'Unknown';
            $sprite = $responsePokemonDetail['sprites']['front_default'] ?? 'No Image';
            $moves = $responsePokemonDetail['moves'] ?? [];

            // Retorne os dados do Pokémon
            return new PokemonData($name, $sprite, $moves);
        } catch (\Exception $e) {
            // Log o erro e defina valores padrão
            return new PokemonData('Error', 'Error', []);
        }
    }
}
