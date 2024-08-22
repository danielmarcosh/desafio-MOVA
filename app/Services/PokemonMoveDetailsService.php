<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\PokemonMoveDetailsServiceInterface;
use App\DTO\MoveData;

class PokemonMoveDetailsService implements PokemonMoveDetailsServiceInterface
{
    private ClientPokemonService $clientPokemonService;

    public function __construct(ClientPokemonService $clientPokemonService)
    {
        $this->clientPokemonService = $clientPokemonService;
    }

    public function getPokemonMoveDetails(int $id): MoveData
    {
        try {
            $responseMove = $this->clientPokemonService->getEffectEntriesById($id);

            $effect = $responseMove['effect_entries'][0]['effect'] ?? 'No Effect';

            return new MoveData($effect);
        } catch (\Exception $e) {
            // Trate a exceção e retorne um valor padrão
            return new MoveData('No Effect');
        }
    }
}
