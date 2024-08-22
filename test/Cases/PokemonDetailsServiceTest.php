<?php

declare(strict_types=1);

namespace HyperfTest\Cases;

use App\Services\PokemonDetailsService;
use App\Services\ClientPokemonService;
use Hyperf\Testing\TestCase;

class PokemonDetailsServiceTest extends TestCase
{
    private PokemonDetailsService $pokemonDetailsService;

    protected function setUp(): void
    {
        parent::setUp();
        $clientPokemonService = new ClientPokemonService();
        $this->pokemonDetailsService = new PokemonDetailsService($clientPokemonService);
    }

    public function testGetPokemonDetails(): void
    {
        $pokemon = $this->pokemonDetailsService->getPokemonDetails(25);
        $this->assertEquals('pikachu', $pokemon->getName());
    }
}
