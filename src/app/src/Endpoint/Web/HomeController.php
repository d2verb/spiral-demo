<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

final class HomeController
{
    use PrototypeTrait;

    #[Route(route: '/', name: 'home', methods: 'GET')]
    public function home(): string
    {
        return $this->views->render('home');
    }
}
