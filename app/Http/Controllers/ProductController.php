<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
            $newProductCategory->category_id = (int)$request->categoryId;
            $newProductCategory->product_id = $newProduct->id;
            $newProductCategory->save();

            $parsedPhotosArray = eval("return " . $request->photos . ";");
            
            //$request->photos should be e.g. ['path1','path2','path3']
            $photoIndex = 1;
            foreach($parsedPhotosArray as $singlePhoto){

                $filename = time() . '-product-' . $newProduct->id . '-photo-' . $photoIndex . ".jpg";
    
                $newProductPhoto = new ProductPhoto();
                $newProductPhoto->product_id = $newProduct->id;
                $newProductPhoto->path = $filename;
                $newProductPhoto->save();

                \Image::make($singlePhoto)->save(public_path('productPhotos/' . $filename));
                
                $photoIndex = $photoIndex + 1;
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

        //var_dump($productList[0]->category_id);
                    
        foreach($productList as $singleProduct){
            //var_dump($singleProduct->categories->category_id);

            $productCategoryName = ProductCategory::where('id', '=', $singleProduct->categories->category_id)
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
            $productCategoryName = ProductCategory::where('id', '=', $singleProduct->categories->category_id)
                                                    ->get(['name']);

            $singleProduct->setAttribute('categoryName', $productCategoryName);
        }

        return response()->json(['productDetails' => $productList]);
    }

    public function closeProduct(Request $request){
        $productId = $request->productId;

        try{
            $closedProduct = Product::where('id', $productId)
                                        ->update(['status' => 1]);

            return response()->json(['closedProduct' => $closedProduct]);  
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function getCategories(){
        $categories = DB::table('product_categories')->get(['id', 'name']);

        return response()->json(['categories' => $categories]);  
    }
}
