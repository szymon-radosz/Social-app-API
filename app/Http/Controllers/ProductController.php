<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Category;
use App\ProductPhoto;
use App\ProductCategoryPivot;
use App\ProductCategory;
use App\Http\Traits\ErrorLogTrait;

class ProductController extends Controller
{
    use ErrorLogTrait;

    public function store(Request $request){
        $newProduct = new Product();
            
        $newProduct->user_id = $request->userId;
        $newProduct->name = $request->name;
        $newProduct->description = $request->description;
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

                $img = \Image::make($singlePhoto);
                $img->stream();
    
                Storage::disk('productPhotos')->put($filename, $img, 'public');

                $photoIndex = $photoIndex + 1;
            }

            return response()->json(['status' => 'OK', 'result' => ['product' => $newProduct, 'productPhoto' => $newProductPhoto]]);
        }catch(\Exception $e){
            $this->storeErrorLog($request->userId, '/saveProduct', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd z zapisem produktu.']); 
        }
    }

    public function loadProductBasedOnCoords(Request $request){
        $lat = $request->lat;
        $lng = $request->lng;

        $maxLat = $lat + 2;
        $maxLng = $lng + 2;

        $minLat = $lat - 2;
        $minLng = $lng - 2;

        try{
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
            return response()->json(['status' => 'OK', 'result' => $productList]);
        }catch(\Exception $e){
            $this->storeErrorLog(0, '/loadProductBasedOnCoords', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd ze zwróceniem produktów w okolicy.']);
        }
    }

    public function loadProductBasedOnId(Request $request){
        $productId = $request->productId;

        try{
            $productList = Product::where([
                                            ['id', $productId]
                                        ])
                                        ->with('productPhotos')
                                        ->with('categories')
                                        ->with('users')
                                        ->get();
                        
            foreach($productList as $singleProduct){
                $productCategoryName = ProductCategory::where('id', '=', $singleProduct->categories->category_id)
                                                        ->get(['name']);

                $singleProduct->setAttribute('categoryName', $productCategoryName);
            }

            return response()->json(['status' => 'OK', 'result' => $productList]);
        }catch(\Exception $e){
            $this->storeErrorLog(0, '/loadProductBasedOnId', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd ze zwróceniem produktów.']);
        }
    }

    public function closeProduct(Request $request){
        $productId = $request->productId;

        try{
            $closedProduct = Product::where('id', $productId)
                                        ->update(['status' => 1]);

            return response()->json(['status' => 'OK', 'result' => $closedProduct]);
        }catch(\Exception $e){
            $this->storeErrorLog(0, '/closeProduct', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd z zamknięciem produktu.']);
        }
    }

    public function getCategories(){
        $categories = DB::table('product_categories')->get(['id', 'name']);

        try{
            return response()->json(['status' => 'OK', 'result' => $categories]);
        }catch(\Exception $e){
            $this->storeErrorLog(0, '/getCategories', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd ze zwróceniem kategorii.']);
        } 
    }

    public function loadUserProductList(Request $request){
        $userId = $request->userId;

        try{
            $productList = Product::where([
                ['user_id', $userId]
            ])
            ->with('productPhotos')
            ->with('categories')
            ->get();

            foreach($productList as $singleProduct){
                //var_dump($singleProduct->categories->category_id);

                $productCategoryName = ProductCategory::where('id', '=', $singleProduct->categories->category_id)
                                                        ->get(['name']);

                $singleProduct->setAttribute('categoryName', $productCategoryName);
            }

            return response()->json(['status' => 'OK', 'result' => $productList]);
        }catch(\Exception $e){
            $this->storeErrorLog($request->userId, '/loadUserProductList', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Problem ze zwróceniem listy aukcji uzytkownika']);
        } 
    }

    public function loadProductsFilter(Request $request){
        $distance = $request->distance ? $request->distance : "";
        $childGender = $request->childGender ? $request->childGender : "";
        $price = $request->price ? $request->price : "";
        $status = $request->status ? $request->status : "";
        $currentUserLat = $request->currentUserLat;
        $currentUserLng = $request->currentUserLng;

        $calculateDistanceDifference = $this->calculateDistanceDifference($distance, $currentUserLat, $currentUserLng);

        if($price !== ""){
            $priceDefault = false;
        }else{
            $priceDefault = true;
        }

        if($status !== ""){
            $statusDefault = false;
        }else{
            $statusDefault = true;
        }

        try{
            $productList = Product::
                    where([
                        ['lat', '>', $calculateDistanceDifference->getData()->latDifferenceBottom], 
                        ['lat', '<', $calculateDistanceDifference->getData()->latDifferenceTop], 
                        ['lng', '>', $calculateDistanceDifference->getData()->lngDifferenceBottom], 
                        ['lng', '<', $calculateDistanceDifference->getData()->lngDifferenceTop]
                    ])
                    ->when(request('price') !== "", function ($q) {
                        if(request('price') === "0-20zł"){
                            return $q->where([['price', '>', 0], ['price', '<=', 20]]);
                        }else if(request('price') === "21zł-50zł"){
                            return $q->where([['price', '>', 20], ['price', '<=', 50]]);
                        }else if(request('price') === "51zł-100zł"){
                            return $q->where([['price', '>', 50], ['price', '<=', 100]]);
                        }else if(request('price') === "100zł-200zł"){
                            return $q->where([['price', '>', 100], ['price', '<=', 200]]);
                        }else if(request('price') === "201zł +"){
                            return $q->where('price', '>', 200);
                        }
                    })
                    ->when(request('status') !== "", function ($q) {
                        if(request('status') === "Nowe"){
                            return $q->where('status', 0);
                        }else if(request('status') === "Używane"){
                            return $q->where('status', 1);
                        }
                    })
                    ->with('productPhotos')
                    ->with('categories')
                    ->with('users')
                    ->get();

            foreach($productList as $singleProduct){
                //var_dump($singleProduct->categories->category_id);

                $productCategoryName = ProductCategory::where('id', '=', $singleProduct->categories->category_id)
                                                        ->get(['name']);

                $singleProduct->setAttribute('categoryName', $productCategoryName);
            }

            return response()->json(['status' => 'OK', 'result' => $productList, 'resultParameters' => [
                                                                                                        ['name' => 'distance', 'value' => $distance, 'default' => $calculateDistanceDifference->getData()->distanceDefault],
                                                                                                        ['name' => 'price', 'value' => $price, 'default' => $priceDefault],
                                                                                                        ['name' => 'status', 'value' => $status, 'default' => $statusDefault]
                                                                                                    ]
                                    ]);  
        }catch(\Exception $e){
            $this->storeErrorLog(0, '/loadProductsFilter', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]);  
        }
    }

    public function calculateDistanceDifference($distance, $currentUserLat, $currentUserLng){
        $coordsLatValue;
        $coordsLngValue;
        $distanceDefault;

        /*
        Degrees of latitude have the same linear distance anywhere in the world, because all lines of latitude are the same size. 
        So 1 degree of latitude is equal to 1/360th of the circumference of the Earth, which is 1/360th of 40,075 km.

        The length of a lines of longitude depends on the latitude. 
        The line of longitude at latitude l will be cos(l)*40,075 km. 
        One degree of longitude will be 1/360th of that.

        So you can work backwards from that. 
        Assuming you want something very close to one square kilometre, you'll want 1 * (360/40075) = 0.008983 degrees of latitude.

        At your example latitude of 53.38292839, the line of longitude will be cos(53.38292839)*40075 = [approx] 23903.297 km long. 
        So 1 km is 1 * (360/23903.297) = 0.015060 degrees.
        */

        if($distance === "1km"){
            $coordsLatValue = 1 * (360/40075);
            $coordsLngValue = 1 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "2km"){
            $coordsLatValue = 3 * (360/40075);
            $coordsLngValue = 3 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "5km"){
            $coordsLatValue = 5 * (360/40075);
            $coordsLngValue = 5 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "10km"){
            $coordsLatValue = 10 * (360/40075);
            $coordsLngValue = 10 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "50km"){
            $coordsLatValue = 50 * (360/40075);
            $coordsLngValue = 50 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "100km"){
            $coordsLatValue = 100 * (360/40075);
            $coordsLngValue = 100 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === ""){
            $coordsLatValue = 10 * (360/40075);
            $coordsLngValue = 10 * (360/23903.297);
            $distanceDefault = true;
        }

        $latDifferenceBottom = $currentUserLat - $coordsLatValue;
        $lngDifferenceBottom = $currentUserLng - $coordsLngValue;

        $latDifferenceTop = $currentUserLat + $coordsLatValue;
        $lngDifferenceTop = $currentUserLng + $coordsLngValue;

        //var_dump([$latDifferenceBottom,$lngDifferenceBottom, $latDifferenceTop, $lngDifferenceTop ]);

        return response()
        ->json(
            [
                'latDifferenceBottom' => $latDifferenceBottom,
                'lngDifferenceBottom' => $lngDifferenceBottom,
                'latDifferenceTop' => $latDifferenceTop,
                'lngDifferenceTop' => $lngDifferenceTop,
                'distanceDefault' => $distanceDefault
            ]
        ); 
    }
}
