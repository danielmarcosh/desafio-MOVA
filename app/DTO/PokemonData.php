<?php

declare(strict_types=1);

namespace App\DTO;

use App\DTO\MoveData;

class PokemonData
{
    public string $name;
    public string $image;
    public array $moves;
    public MoveData $effect_entries;

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
    public function setEffectEntries(MoveData $effect_entries): void
    {
        $this->effect_entries = $effect_entries;
    }
}
