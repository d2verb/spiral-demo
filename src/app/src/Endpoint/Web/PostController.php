<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Database\Post;
use Psr\Http\Message\ResponseInterface;
use Spiral\Http\Exception\ClientException\NotFoundException;
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

    #[Route(route: '/api/post/<id>', name: 'post.get', methods: 'GET')]
    public function get(string $id): ResponseInterface
    {
        $post = $this->posts->findByPK($id);
        if ($post === null) {
            throw new NotFoundException('post not found');
        }

        return $this->postView->json($post);
    }
}
