<?php

namespace App\Http\Controllers;

use App\Http\Traits\CalculateDistanceDifferenceTrait;
use App\Http\Traits\ErrorLogTrait;
use App\Product;
use App\ProductCategory;
use App\ProductCategoryPivot;
use App\ProductPhoto;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use ErrorLogTrait;
    use CalculateDistanceDifferenceTrait;

    public function store(Request $request)
    {
        $newProduct = new Product();

        $newProduct->user_id = $request->userId;
        $newProduct->name = $request->name;
        $newProduct->description = $request->description;
        $newProduct->lat = $request->lat;
        $newProduct->lng = $request->lng;
        $newProduct->status = $request->status;
        $newProduct->state = $request->state;

        $checkIfProductExists = Product::where([
            ['name', $request->name],
            ['description', $request->description],
        ])
            ->first();

        if ($checkIfProductExists === null) {
            try {
                $newProduct->save();

                $newProductCategory = new ProductCategoryPivot();
                $newProductCategory->category_id = (int) $request->categoryId;
                $newProductCategory->product_id = $newProduct->id;
                $newProductCategory->save();

                $parsedPhotosArray = eval("return " . $request->photos . ";");

                $photoIndex = 1;

                foreach ($parsedPhotosArray as $singlePhoto) {

                    $filename = 'productPhotos/' . time() . '-product-' . $newProduct->id . '-photo-' . $photoIndex . ".jpg";

                    $img = $singlePhoto;
                    $img = str_replace('data:image/png;base64,', '', $img);
                    $img = str_replace(' ', '+', $img);

                    Storage::disk('s3')->put($filename, base64_decode($img));
                    Storage::disk('s3')->setVisibility($filename, 'public');

                    $url = Storage::disk('s3')->url($filename);

                    $newProductPhoto = new ProductPhoto();
                    $newProductPhoto->product_id = $newProduct->id;

                    $newProductPhoto->path = $url;
                    $newProductPhoto->save();

                    $photoIndex = $photoIndex + 1;
                }

                return response()->json(['status' => 'OK', 'result' => ['product' => $newProduct, 'productPhoto' => $newProductPhoto]]);
            } catch (\Exception $e) {
                $this->storeErrorLog($request->userId, '/saveProduct', $e->getMessage());

                return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]);
            }
        }
    }

    public function loadActiveProductBasedOnCoords(Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;

        $maxLat = $lat + 2;
        $maxLng = $lng + 2;

        $minLat = $lat - 2;
        $minLng = $lng - 2;

        try {
            $productList = Product::where([
                ['lat', '>', $minLat],
                ['lat', '<', $maxLat],
                ['lng', '>', $minLng],
                ['lng', '<', $maxLng],
                ['status', '=', 0],
            ])
                ->with('productPhotos')
                ->with('categories')
                ->get();

            //var_dump($productList[0]->category_id);

            foreach ($productList as $singleProduct) {
                //var_dump($singleProduct->categories->category_id);

                $productCategoryName = ProductCategory::where('id', '=', $singleProduct->categories->category_id)
                    ->get(['name']);

                $singleProduct->setAttribute('categoryName', $productCategoryName);
            }
            return response()->json(['status' => 'OK', 'result' => $productList]);
        } catch (\Exception $e) {
            $this->storeErrorLog(0, '/loadProductBasedOnCoords', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd ze zwróceniem produktów w okolicy.']);
        }
    }

    public function loadProductBasedOnId(Request $request)
    {
        $productId = $request->productId;

        try {
            $productList = Product::where([
                ['id', $productId],
            ])
                ->with('productPhotos')
                ->with('categories')
                ->with('users')
                ->get();

            foreach ($productList as $singleProduct) {
                $productCategoryName = ProductCategory::where('id', '=', $singleProduct->categories->category_id)
                    ->get(['name']);

                $singleProduct->setAttribute('categoryName', $productCategoryName);
            }

            return response()->json(['status' => 'OK', 'result' => $productList]);
        } catch (\Exception $e) {
            $this->storeErrorLog(0, '/loadProductBasedOnId', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd ze zwróceniem produktów.']);
        }
    }

    public function closeProduct(Request $request)
    {
        $productId = $request->productId;

        try {
            $closedProduct = Product::where('id', $productId)
                ->update(['status' => 1]);

            return response()->json(['status' => 'OK', 'result' => $closedProduct]);
        } catch (\Exception $e) {
            $this->storeErrorLog(0, '/closeProduct', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd z zamknięciem produktu.']);
        }
    }

    public function reactivateProduct(Request $request)
    {
        $productId = $request->productId;

        try {
            $reactivatedProduct = Product::where('id', $productId)
                ->update(['status' => 0]);

            return response()->json(['status' => 'OK', 'result' => $reactivatedProduct]);
        } catch (\Exception $e) {
            $this->storeErrorLog(0, '/reactivateProduct', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd z wznowieniem produktu.']);
        }
    }

    public function getCategories()
    {
        $categories = DB::table('product_categories')->get(['id', 'name']);

        try {
            return response()->json(['status' => 'OK', 'result' => $categories]);
        } catch (\Exception $e) {
            $this->storeErrorLog(0, '/getCategories', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd ze zwróceniem kategorii.']);
        }
    }

    public function loadUserProductList(Request $request)
    {
        $userId = $request->userId;

        try {
            $productList = Product::where([
                ['user_id', $userId],
            ])
                ->with('productPhotos')
                ->with('categories')
                ->get();

            foreach ($productList as $singleProduct) {
                //var_dump($singleProduct->categories->category_id);

                $productCategoryName = ProductCategory::where('id', '=', $singleProduct->categories->category_id)
                    ->get(['name']);

                $singleProduct->setAttribute('categoryName', $productCategoryName);
            }

            return response()->json(['status' => 'OK', 'result' => $productList]);
        } catch (\Exception $e) {
            $this->storeErrorLog($request->userId, '/loadUserProductList', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Problem ze zwróceniem listy aukcji uzytkownika']);
        }
    }

    public function loadProductsFilter(Request $request)
    {
        $distance = $request->distance ? $request->distance : "";
        $childGender = $request->childGender ? $request->childGender : "";
        $status = $request->status ? $request->status : "";
        $active = $request->active ? $request->active : true;
        $currentUserLat = $request->currentUserLat;
        $currentUserLng = $request->currentUserLng;

        $calculateDistanceDifference = $this->calculateDistanceDifference($distance, $currentUserLat, $currentUserLng);

        if ($status !== "") {
            $statusDefault = false;
        } else {
            $statusDefault = true;
        }

        try {
            $productList = Product::
                where([
                ['lat', '>', $calculateDistanceDifference->getData()->latDifferenceBottom],
                ['lat', '<', $calculateDistanceDifference->getData()->latDifferenceTop],
                ['lng', '>', $calculateDistanceDifference->getData()->lngDifferenceBottom],
                ['lng', '<', $calculateDistanceDifference->getData()->lngDifferenceTop],
                ['status', '=', 0],
            ])
                ->when(request('status') !== null, function ($q) {
                    //var_dump(request('status'));
                    if (request('status') === "Nowe") {
                        return $q->where('state', 0);
                    } else if (request('status') === "Używane") {
                        return $q->where('state', 1);
                    }
                })
                ->with('productPhotos')
                ->with('categories')
                ->with('users')
                ->get();

            foreach ($productList as $singleProduct) {
                //var_dump($singleProduct->categories->category_id);

                $productCategoryName = ProductCategory::where('id', '=', $singleProduct->categories->category_id)
                    ->get(['name']);

                $singleProduct->setAttribute('categoryName', $productCategoryName);
            }

            return response()->json(['status' => 'OK', 'result' => $productList, 'resultParameters' => [
                ['name' => 'distance', 'value' => $distance, 'default' => $calculateDistanceDifference->getData()->distanceDefault],
                ['name' => 'status', 'value' => $status, 'default' => $statusDefault],
            ],
            ]);
        } catch (\Exception $e) {
            $this->storeErrorLog(0, '/loadProductsFilter', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]);
        }
    }
}
