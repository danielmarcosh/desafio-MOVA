<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\PokemonMoveDetailsServiceInterface;
use App\Services\ClientPokemonService;
use App\DTO\MoveData;
use Hyperf\Coroutine\Coroutine;
use Hyperf\Coroutine\WaitGroup;

class PokemonMoveDetailsService implements PokemonMoveDetailsServiceInterface
{
    private $wg;
    private $clientPokemonService;

    public function __construct(ClientPokemonService $clientPokemonService)
    {
        $this->clientPokemonService = $clientPokemonService;
    }

    public function getPokemonMoveDetails(int $id): MoveData
    {
        // Inicialize o WaitGroup
        $this->wg = new WaitGroup();
        $this->wg->add(1);


        $move = new MoveData('');

        Coroutine::create(function () use (&$move, $id) {
            try {
                // Realize
                $responseMove = $this->clientPokemonService->getEffectEntriesById($id);

                $effect = $responseMove['effect_entries'][0]['effect'] ?? 'No Effect';

                // Atualize o objeto Pokémon
                $move->setEffectEntries($effect);
            } catch (\Exception $e) {
                // Trate a exceção
                $move->setEffectEntries('No Effect');
            } finally {
                // Marque a tarefa como concluída
                $this->wg->done();
            }
        });

        // Aguarde até que todas as tarefas sejam concluídas
        $this->wg->wait();

        return $move;
    }
}
