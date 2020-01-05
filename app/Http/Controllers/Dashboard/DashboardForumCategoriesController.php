<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\ErrorLogTrait;
use App\PostCategory;
use Illuminate\Http\Request;

class DashboardForumCategoriesController extends Controller
{
    use ErrorLogTrait;

    public function getCategories()
    {
        try {
            $categories = PostCategory::get();

            return response()->json(['status' => 'OK', 'result' => ['categories' => $categories]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/get-forum-categories', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get forum categories']);
        }
    }

    public function updateCategory(Request $request)
    {
        try {
            $id = $request->input('id');
            $name = $request->input('name');

            $category = PostCategory::where('id', $id)
                ->update(["name" => $name]);

            return response()->json(['status' => 'OK', 'result' => ['category' => $category]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/update-category', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get category']);
        }
    }

    public function blockCategory(Request $request)
    {
        try {
            $id = $request->input('id');

            $category = PostCategory::where('id', $id)->first();

            if ($category->blocked == 0) {
                $updatedCategory = PostCategory::where('id', $id)
                    ->update(['blocked' => 1]);
            } else {
                $updatedCategory = PostCategory::where('id', $id)
                    ->update(['blocked' => 0]);
            }

            return response()->json(['status' => 'OK', 'result' => ['category' => $updatedCategory]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/block-forum-category', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get updatedCategory']);
        }
    }

    public function addCategory(Request $request)
    {
        try {
            $name = $request->input('name');

            $category = new PostCategory();

            $category->name = $name;

            $category->save();

            return response()->json(['status' => 'OK', 'result' => ['category' => $category]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/add-forum-category', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get category']);
        }
    }

}
