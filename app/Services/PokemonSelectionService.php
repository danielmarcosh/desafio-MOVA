<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\PokemonSelectionServiceInterface;
use Hyperf\Coroutine\Coroutine;
use Hyperf\Coroutine\WaitGroup;

class PokemonSelectionService implements PokemonSelectionServiceInterface
{
    private $wg;

    public function __construct() {}

    public function selectRandomPokemons(int $count): array
    {
        // Seleciona pokémons aleatoriamente usando corrotinas
        $pokemons = [];
        $this->wg = new WaitGroup();

        for ($i = 0; $i < $count; $i++) {
            $this->wg->add(1); // Adiciona uma corrotina ao WaitGroup
            Coroutine::create(function () use (&$pokemons, $i) {
                // Lógica para selecionar pokémons aleatórios
                $pokemons[$i] = $this->getRandomPokemon();
                $this->wg->done(); // Finaliza a corrotina
            });
        }

        $this->wg->wait(); // Aguarda todas as corrotinas finalizarem
        return $pokemons;
    }

    private function getRandomPokemon(): int
    {
        // Implementação para obter ID de um Pokémon aleatório
        return rand(0, 1302);
    }
}
