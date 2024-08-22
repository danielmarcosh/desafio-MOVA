<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\PokemonDetailsServiceInterface;
use App\Services\ClientPokemonService;
use App\DTO\PokemonData;
use Hyperf\Coroutine\Coroutine;
use Hyperf\Coroutine\WaitGroup;

class PokemonDetailsService implements PokemonDetailsServiceInterface
{
    private $wg;
    private $clientPokemonService;

    public function __construct(ClientPokemonService $clientPokemonService)
    {
        $this->clientPokemonService = $clientPokemonService;
    }

    public function getPokemonDetails(int $id): PokemonData
    {
        // Inicialize o WaitGroup
        $this->wg = new WaitGroup();
        $this->wg->add(1);

        // Defina um valor padrão para $pokemon
        $pokemon = new PokemonData('', '', []);

        Coroutine::create(function () use (&$pokemon, $id) {
            try {
                // Realize as requisições
                $responsePokemonDetail = $this->clientPokemonService->getPokemonById($id);

                // Valide e defina os dados do Pokémon
                $name = $responsePokemonDetail['name'] ?? 'Unknown';
                $sprite = $responsePokemonDetail['sprites']['front_default'] ?? 'No Image';
                $moves = $responsePokemonDetail['moves'] ?? [];

                // Atualize o objeto Pokémon
                $pokemon = new PokemonData($name, $sprite, $moves);
            } catch (\Exception $e) {
                // Log o erro e defina valores padrão
                // Você pode substituir 'Error' por uma mensagem de erro mais apropriada
                $pokemon = new PokemonData('Error', 'Error', []);
            } finally {
                // Marque a tarefa como concluída
                $this->wg->done();
            }
        });

        // Aguarde até que todas as tarefas sejam concluídas
        $this->wg->wait();

        return $pokemon;
    }
}
