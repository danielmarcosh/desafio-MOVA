<?php

declare(strict_types=1);

namespace App\DTO;

class MoveData
{
    public string $effect_entries;

    public function __construct(string $effect_entries)
    {
        $this->effect_entries = $effect_entries;
    }

    public function getEffectEntries(): string
    {
        return $this->effect_entries;
    }

    public function setEffectEntries(string $effect_entries): void
    {
        $this->effect_entries = $effect_entries;
    }
}
