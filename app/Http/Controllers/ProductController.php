<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\ProductPhoto;
use App\ProductCategoryPivot;
use App\ProductCategory;

class ProductController extends Controller
{
    public function store(Request $request){
        $newProduct = new Product();
            
        $newProduct->user_id = $request->userId;
        $newProduct->name = $request->name;
        $newProduct->child_gender = $request->childGender;
        $newProduct->price = $request->price;
        $newProduct->lat = $request->lat;
        $newProduct->lng = $request->lng;
        $newProduct->status = $request->status;
        $newProduct->state = $request->state;

        try{
            $newProduct->save();

            $newProductCategory = new ProductCategoryPivot();
            $newProductCategory->category_id = $request->categoryId;
            $newProductCategory->product_id = $newProduct->id;
            $newProductCategory->save();

            $parsedPhotosArray = eval("return " . $request->photos . ";");
            
            //$request->photos should be e.g. ['path1','path2','path3']
            foreach($parsedPhotosArray as $singlePhoto){
                $newProductPhoto = new ProductPhoto();
                $newProductPhoto->product_id = $newProduct->id;
                $newProductPhoto->path = $singlePhoto;
                $newProductPhoto->save();
            }

            return response()->json(['product' => $newProduct, 'productPhoto' => $newProductPhoto]); 
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function loadProductBasedOnCoords(Request $request){
        $lat = $request->lat;
        $lng = $request->lng;

        $maxLat = $lat + 2;
        $maxLng = $lng + 2;

        $minLat = $lat - 2;
        $minLng = $lng - 2;

        $productList = Product::where([
                                        ['lat', '>', $minLat], 
                                        ['lat', '<', $maxLat], 
                                        ['lng', '>', $minLng], 
                                        ['lng', '<', $maxLng]
                                    ])
                                    ->with('productPhotos')
                                    ->with('categories')
                                    ->get();
                    
        foreach($productList as $singleProduct){
            $productCategoryName = ProductCategory::where('id', '=', $singleProduct->categories->id)
                                                    ->get(['name']);

            $singleProduct->setAttribute('categoryName', $productCategoryName);
        }

        return response()->json(['productList' => $productList]);
    }

    public function loadProductBasedOnId(Request $request){
        $productId = $request->productId;

        $productList = Product::where([
                                        ['id', $productId]
                                    ])
                                    ->with('productPhotos')
                                    ->with('categories')
                                    ->get();
                    
        foreach($productList as $singleProduct){
            $productCategoryName = ProductCategory::where('id', '=', $singleProduct->categories->id)
                                                    ->get(['name']);

            $singleProduct->setAttribute('categoryName', $productCategoryName);
        }

        return response()->json(['productDetails' => $productList]);
    }
}
