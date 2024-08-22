<?php

declare(strict_types=1);

namespace App\Services;

class PokemonSelectionService
{
    public function selectRandomPokemons(int $count): array
    {
        $pokemons = [];

        for ($i = 0; $i < $count; $i++) {
            $pokemons[$i] = $this->getRandomPokemon();
        }

        return $pokemons;
    }

    private function getRandomPokemon(): int
    {
        // Implementação para obter ID de um Pokémon aleatório
        return rand(0, 1302);
    }
}
