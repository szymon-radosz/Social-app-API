<?php

//namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testCreatePost(){
        //create factory example user
        $post = factory(App\Post::class)->make();

        $data = [
            'title' => $post->title,
            'description' => $post->description,
            'userId' => $post->user_id,
            'categoryId' => $post->category_id
        ];

        $response = $this->json('POST', '/api/savePost', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'status',
                'result'
            ]
        );
    }

    public function testReturnPosts(){
        $response = $this->json('GET', '/api/posts');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                'status',
                'result'
            ]
        );
    }

    public function testPostComment(){
        //create factory example user
        $postComment = factory(App\PostComment::class)->make();

        $data = [
            'body' => $postComment->body,
            'postId' => $postComment->post_id,
            'userId' => $postComment->user_id
        ];

        $response = $this->json('POST', '/api/savePostComment', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'status',
                'result'
            ]
        );
    }

    public function testPostVote(){
        //create factory example user
        $post = factory(App\Post::class)->make();

        $data = [
            'postId' => $post->id,
            'userId' => $post->user_id
        ];

        $response = $this->json('POST', '/api/savePostVote', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'status',
                'result'
            ]
        );
    }

    public function testPostCommentVote(){
        //create factory example user
        $comment = factory(App\PostComment::class)->make();

        $data = [
            'commentId' => $comment->id,
            'userId' => $comment->user_id
        ];

        $response = $this->json('POST', '/api/saveCommentVote', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'status',
                'result'
            ]
        );
    }

    public function testPostById(){
        //create factory example user
        $post = factory(App\Post::class)->make();

        $data = [
            'postId' => $post->id
        ];

        $response = $this->json('POST', '/api/getPostById', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'status',
                'result'
            ]
        );
    }

    public function testPostByCategoryId(){
        //create factory example user
        $post = factory(App\Post::class)->make();

        $data = [
            'categoryId' => $post->category_id
        ];

        $response = $this->json('POST', '/api/getPostByCategoryId', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'status',
                'result'
            ]
        );
    }
}
