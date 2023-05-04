<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use Spiral\Router\Annotation\Route;

final class CurrentDateController
{
    #[Route(route: '/date', name: 'current-date', methods: 'GET')]
    public function show(): string
    {
        return \date('Y-m-d H:i:s');
    }
}
