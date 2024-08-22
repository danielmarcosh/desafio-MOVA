<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DTO\MoveData;

interface PokemonMoveDetailsServiceInterface
{
    public function getPokemonMoveDetails(int $id): MoveData;
}
