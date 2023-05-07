<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Database\Post;
use App\Endpoint\Web\Filter\CommentFilter;
use Psr\Http\Message\ResponseInterface;
use Spiral\DataGrid\GridFactory;
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

    #[Route(route: '/api/post/<post>/comment', name: 'post.comment', methods: 'POST')]
    public function comment(Post $post, CommentFilter $commentFilter): array
    {
        $this->commentService->comment(
            $post,
            $this->users->findOne(),
            $commentFilter->message
        );

        return ['status' => 201];
    }

    #[Route(route: '/posts', name: 'post.all', methods: 'GET')]
    public function all(GridFactory $grids): string
    {
        $grid = $grids->create($this->posts->findAllWithAuthor(), $this->postGrid);

        return $this->views->render('posts', ['posts' => $grid]);
    }

    #[Route(route: '/post/<id>', name: 'post.view', methods: 'GET')]
    public function view(string $id): string
    {
        $post = $this->posts->findOneWithComments($id);
        if ($post === null) {
            throw new NotFoundException();
        }

        return $this->views->render('post', ['post' => $post]);
    }
}
