<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostComment;
use App\Product;
use App\User;
use Carbon\Carbon;

class DashboardStatsController extends Controller
{
    public function getUsers()
    {
        try {
            $users = User::where('created_at', '>', Carbon::now()->startOfWeek())
                ->where('created_at', '<', Carbon::now()->endOfWeek())
                ->count();

            return response()->json(['status' => 'OK', 'result' => ['users' => $users]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/get-users', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get users']);
        }
    }

    public function getProducts()
    {
        try {
            $products = Product::where('created_at', '>', Carbon::now()->startOfWeek())
                ->where('created_at', '<', Carbon::now()->endOfWeek())
                ->count();

            return response()->json(['status' => 'OK', 'result' => ['products' => $products]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/get-products', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get products']);
        }
    }

    public function getForumPosts()
    {
        try {
            $forumPosts = Post::where('created_at', '>', Carbon::now()->startOfWeek())
                ->where('created_at', '<', Carbon::now()->endOfWeek())
                ->count();

            return response()->json(['status' => 'OK', 'result' => ['forumPosts' => $forumPosts]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/get-forum-posts', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get forumPosts']);
        }
    }

    public function getForumComments()
    {
        try {
            $forumComments = PostComment::where('created_at', '>', Carbon::now()->startOfWeek())
                ->where('created_at', '<', Carbon::now()->endOfWeek())
                ->count();

            return response()->json(['status' => 'OK', 'result' => ['forumComments' => $forumComments]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/get-forum-comments', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get forumComments']);
        }
    }
}
