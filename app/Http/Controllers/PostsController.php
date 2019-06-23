<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostComment;
use App\PostVote;
use App\PostCommentVote;
use App\PostCategory;

class PostsController extends Controller
{
    public function index(){
        try{
            $posts = Post::with('votes')
                                ->with('comments.users')
                                ->with('comments.votes')
                                ->latest('created_at')
                                ->get();

            return response()->json(['status' => 'OK', 'result' => $posts]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zwróceniu listy postów.']);
        }
    }

    public function store(Request $request){
        $title = $request->title;
        $description = $request->description;
        $userId = $request->userId;
        $categoryId = $request->categoryId;

        try{
            $post = new Post();

            $post->title = $title;
            $post->description = $description;
            $post->user_id = $userId;
            $post->category_id = $categoryId;
    
            $post->save();

            return response()->json(['status' => 'OK', 'result' => $post]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zapisie posta.']);
        }
    }

    public function savePostComment(Request $request){
        $body = $request->body;
        $userId = $request->userId;
        $postId = $request->postId;

        try{
            $postComment = new PostComment();

            $postComment->body = $body;
            $postComment->user_id = $userId;
            $postComment->post_id = $postId;

            $postComment->save();

            return response()->json(['status' => 'OK', 'result' => $postComment]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zapisie posta.']);
        }
    }

    public function savePostVote(Request $request){
        $userId = $request->userId;
        $postId = $request->postId;

        try{
            $checkIfUserVoted = PostVote::where([['user_id', $userId], ['post_id', $postId]])
                                            ->count();

            if($checkIfUserVoted === 0){
                $postVote = new PostVote();

                $postVote->post_id = $postId;
                $postVote->user_id = $userId;

                $postVote->save();

                return response()->json(['status' => 'OK', 'result' => $postVote]);
            }else{
                return response()->json(['status' => 'ERR', 'result' => 'Oddano juz głos z tego konta.']);
            }
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zapisie głosu na post.']);
        }
    }

    public function saveCommentVote(Request $request){
        $userId = $request->userId;
        $commentId = $request->commentId;

        try{
            $checkIfUserVoted = PostCommentVote::where([['user_id', $userId], ['comment_id', $commentId]])
                                                            ->count();

            if($checkIfUserVoted === 0){
                $postCommentVote = new PostCommentVote();

                $postCommentVote->user_id = $userId;
                $postCommentVote->comment_id = $commentId;

                $postCommentVote->save();

                return response()->json(['status' => 'OK', 'result' => $postCommentVote]);
            }else{
                return response()->json(['status' => 'ERR', 'result' => 'Oddano juz głos z tego konta.']);
            }
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zapisie głosu na komentarz do posta']);
        }
    }

    public function getPostById(Request $request){
        $postId = $request->postId;

        try{
            $post = Post::where('id', $postId)
                                ->with('votes')
                                ->with('users')
                                ->with('comments.users')
                                ->with('comments.votes')
                                ->latest('created_at')
                                ->get();

            return response()->json(['status' => 'OK', 'result' => $post]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]);
        }
    }

    public function getPostByCategoryId(Request $request){
        $categoryId = $request->categoryId;

        try{
            $posts = Post::where('category_id', $categoryId)
                                ->with('votes')
                                ->with('comments.users')
                                ->with('comments.votes')
                                ->latest('created_at')
                                ->get();

            return response()->json(['status' => 'OK', 'result' => $posts]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zwróćeniu postów po id kategorii.']);
        }
    }

    public function getPostCommentsByPostId(Request $request){
        $postId = $request->postId;

        try{
            $postComments = PostComment::where('post_id', $postId)
                                ->with('votes')
                                ->with('users')
                                ->get();

            return response()->json(['status' => 'OK', 'result' => $postComments]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]);
        }
    }

    public function getCategories(){
        try{
            $categories = PostCategory::with('posts')->get();

            return response()->json(['status' => 'OK', 'result' => $categories]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Bład przy pobraniu kategorii']);
        }
    }
}
