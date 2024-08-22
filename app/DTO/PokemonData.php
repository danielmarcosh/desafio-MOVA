<?php

declare(strict_types=1);

namespace App\DTO;

use App\DTO\MoveData;

class PokemonData
{
    public string $name;
    public string $image;
    public array $moves;

    public function __construct(string $name, string $image, array $moves)
    {
        $this->name = $name;
        $this->image = $image;
        $this->moves = $moves;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getImage(): string
    {
        return $this->image;
    }
    public function getMoves(): array
    {
        return $this->moves;
    }
}
