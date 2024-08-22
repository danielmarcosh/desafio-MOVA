<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Services\ClientPokemonService;
use App\Services\PokemonSelectionService;
use App\Services\PokemonDetailsService;

class IndexController extends AbstractController
{
    public function index(ResponseInterface $response)
    {
        $service = new PokemonDetailsService(new ClientPokemonService);
        
        return $response->json($service->getPokemonDetails(25));
    }
}
