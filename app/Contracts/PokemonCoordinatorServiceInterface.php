<?php

declare(strict_types=1);

namespace App\Contracts;

interface PokemonCoordinatorServiceInterface
{
    public function coordinatePokemonSelection(): array;
}
