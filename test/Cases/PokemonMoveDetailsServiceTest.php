<?php

declare(strict_types=1);

namespace HyperfTest\Cases;

use App\Services\PokemonMoveDetailsService;
use App\Services\ClientPokemonService;
use Hyperf\Testing\TestCase;

class PokemonMoveDetailsServiceTest extends TestCase
{
    private PokemonMoveDetailsService $pokemonDetailsService;

    protected function setUp(): void
    {
        parent::setUp();
        $clientPokemonService = new ClientPokemonService();
        $this->pokemonDetailsService = new PokemonMoveDetailsService($clientPokemonService);
    }

    public function testGetPokemonDetails(): void
    {
        $move = $this->pokemonDetailsService->getPokemonMoveDetails(25);
        $this->assertEquals('Inflicts regular damage.', $move->getEffectEntries());
    }
}
