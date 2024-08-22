<?php

declare(strict_types=1);

namespace App\Contracts;

interface PokemonSelectionServiceInterface
{
    public function selectRandomPokemons(int $count): array;
}
