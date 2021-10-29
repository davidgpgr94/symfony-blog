<?php

namespace App\Infrastructure\BlogFront\Controller;

use App\Application\GetPostAuthor\GetPostAuthorQuery;
use App\Application\GetPostAuthor\GetPostAuthorUseCase;
use App\Application\GetPosts\GetPostsQuery;
use App\Application\GetPosts\GetPostsUseCase;
use App\Domain\Author\Errors\AuthorNotExists;
use App\Domain\Post\Errors\PostNotExists;
use App\Domain\Post\Post;
use App\Domain\Post\PostId;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/posts")
 */
class PostsController extends BaseWebController
{
    /**
     * @Route("", methods={"GET"}, name="get_all_posts")
     *
     * @param GetPostsUseCase $getPostsUseCase
     * @return Response
     */
    public function allPosts(GetPostsUseCase $getPostsUseCase): Response
    {
        $query = new GetPostsQuery();

        $posts = $getPostsUseCase->search($query);

        return $this->response(
            'posts/posts.html.twig',
            [
                'posts' => $posts,
                'title_page' => 'Todos los posts'
            ]
        );
    }

    /**
     * @Route("/{postId}", methods={"GET"}, name="post_details", requirements={"postid"="\d+"})
     *
     * @param int $postId
     * @param GetPostsUseCase $getPostsUseCase
     * @param GetPostAuthorUseCase $getPostAuthorUseCase
     * @return Response
     */
    public function postDetails(
        int $postId,
        GetPostsUseCase $getPostsUseCase,
        GetPostAuthorUseCase $getPostAuthorUseCase
    ): Response
    {
        $getPostQuery = new GetPostsQuery(new PostId($postId));

        try {
            /** @var Post $post */
            $post = $getPostsUseCase->search($getPostQuery)->getFirst();

            $getPostAuthorQuery = new GetPostAuthorQuery($post->getId());
            $postAuthor = $getPostAuthorUseCase->search($getPostAuthorQuery);

            $post->setAuthor($postAuthor);

            return $this->response(
                'posts/post.html.twig',
                [
                    'title' => "Symfony Blog | #{$post->getId()}",
                    'post' => $post,
                    'title_page' => $post->getTitle()
                ]
            );
        } catch (PostNotExists $postNotExists) {
            return $this->response(
                'errors/not_found.html.twig',
                [
                    'item_not_found' => 'Post'
                ]
            );
        } catch (AuthorNotExists $authorNotExists) {
            return $this->response(
                'errors/not_found.html.twig',
                [
                    'item_not_found' => "Autor del post #{$post->getId()}"
                ]
            );
        }
    }
}
