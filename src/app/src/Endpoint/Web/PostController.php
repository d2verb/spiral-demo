<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Database\Post;
use Psr\Http\Message\ResponseInterface;
use Spiral\DataGrid\GridFactory;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class PostController
{
    use PrototypeTrait;

    #[Route(route: '/api/test/<id>', name: 'post.test', methods: 'GET')]
    public function test(string $id): array
    {
        return [
            'status' => 200,
            'data' => [
                'id' => $id,
            ],
        ];
    }

    #[Route(route: '/api/post/<post>', name: 'post.get', methods: 'GET')]
    public function get(Post $post): ResponseInterface
    {
        return $this->postView->json($post);
    }

    #[Route(route: '/api/post', name: 'post.list', methods: 'GET')]
    public function list(GridFactory $grids): array
    {
        $grid = $grids->create($this->posts->findAllWithAuthor(), $this->postGrid);
        return [
            'posts' => array_map(
                [$this->postView, 'map'],
                iterator_to_array($grid->getIterator())
            ),
        ];
    }
}
