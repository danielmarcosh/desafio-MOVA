<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DTO\PokemonData;

interface PokemonDetailsServiceInterface
{
    public function getPokemonDetails(int $id): PokemonData;
}
