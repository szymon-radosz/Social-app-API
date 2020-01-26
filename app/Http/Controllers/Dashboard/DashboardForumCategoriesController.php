<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\ErrorLogTrait;
use App\PostCategory;
use App\Translation;
use Illuminate\Http\Request;

class DashboardForumCategoriesController extends Controller
{
    use ErrorLogTrait;

    public function index()
    {
        try {
            $categories = PostCategory::get();

            return response()->json(['status' => 'OK', 'result' => ['categories' => $categories]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/get-forum-categories', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get forum categories']);
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

    public function store(Request $request)
    {
        try {
            $name = $request->input('name');

            $category = new PostCategory();
            $category->name = $name;
            $category->save();

            $translation = new Translation();
            $translation->name = $name;
            $translation->en = $name;
            $translation->blocked = 1;
            $translation->save();

            return response()->json(['status' => 'OK', 'result' => ['category' => $category]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/add-forum-category', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot save category']);
        }
    }

}
