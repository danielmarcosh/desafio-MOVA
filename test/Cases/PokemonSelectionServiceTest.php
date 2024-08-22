<?php

declare(strict_types=1);

namespace HyperfTest\Cases;

use App\Services\PokemonSelectionService;
use Hyperf\Testing\TestCase;

class PokemonSelectionServiceTest extends TestCase
{
    public function testSelectRandomPokemons()
    {
        $service = new PokemonSelectionService();
        $pokemons = $service->selectRandomPokemons(5);

        $this->assertCount(5, $pokemons);
    }
}
