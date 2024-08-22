<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\PokemonCoordinatorServiceInterface;
use App\DTO\PokemonDetails;
use Hyperf\Coroutine\Coroutine;
use Hyperf\Coroutine\WaitGroup;

class PokemonCoordinatorService implements PokemonCoordinatorServiceInterface
{
    private PokemonSelectionService $pokemonSelectionService;
    private PokemonDetailsService $pokemonDetailsService;
    private PokemonMoveDetailsService $pokemonMoveDetailsService;

    public function __construct()
    {
        $this->pokemonSelectionService = new PokemonSelectionService();
        $this->pokemonDetailsService = new PokemonDetailsService(new ClientPokemonService());
        $this->pokemonMoveDetailsService = new PokemonMoveDetailsService(new ClientPokemonService());
    }

    public function coordinatePokemonSelection(): array
    {
        $pokemonIds = $this->pokemonSelectionService->selectRandomPokemons(5);
        $pokemonDetailsList = [];
        $wg = new WaitGroup();

        foreach ($pokemonIds as $id) {
            $wg->add(1);

            Coroutine::create(function () use ($id, &$pokemonDetailsList, $wg) {
                try {
                    $pokemonData = $this->pokemonDetailsService->getPokemonDetails($id);
                    $moveDetails = $this->pokemonMoveDetailsService->getPokemonMoveDetails($id);

                    $pokemonDetails = new PokemonDetails(
                        $pokemonData->getName(),
                        $pokemonData->getImage(),
                        $pokemonData->getMoves(),
                        $moveDetails
                    );

                    // Use jsonSerialize() para obter a representação serializável
                    $pokemonDetailsList[] = $pokemonDetails->jsonSerialize();
                } catch (\Exception $e) {
                    // Log the error or handle it as needed
                } finally {
                    $wg->done();
                }
            });
        }

        $wg->wait(); // Espera todas as coroutines terminarem
        return $pokemonDetailsList;
    }
}
