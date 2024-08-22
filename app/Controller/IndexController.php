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
use App\Services\PokemonCoordinatorService;

class IndexController extends AbstractController
{
    public function index(ResponseInterface $response)
    {
        $service = new PokemonCoordinatorService();

        return $response->json($service->coordinatePokemonSelection());
    }
}
