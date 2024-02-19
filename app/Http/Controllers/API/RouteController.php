<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //api for product list **http://127.0.0.1:8000/api/product/list**
    public function productList(){
        $data=Product::get();
        return response()->json($data, 200);
    }

    public function category(){
        $user=User::get();
        $category=Category::get();
        $data=[
           'user'=> $user,
           'category'=> $category
        ];

        return response()->json($data, 200);
    }

    //category list page
    public function categoryList(){
        $data=category::orderBy('created_at','desc')->get();
        return response()->json($data, 200);
    }

    //category update
    public function categoryUpdate(Request $request){
        $categoryId=$request->category_id;
        $dbSource=Category::where('id',$categoryId)->first();
        if(isset( $dbSource)){
            $data=$this->getCategoryData($request);
            category::where('id', $categoryId)->update($data);
            $response= Category::where('id',$categoryId)->first();
           return response()->json(['message'=>' category updated successfully','category'=>$response],200);
        }
        return response()->json(["message"=>"Something wrong here doesn't have that category id "]);
    }
    //get category data
    private function getCategoryData($request){
        return[
            'name'=>$request->name,
            'updated_at'=>Carbon::now()
        ];
    }


    //category delete with post method
    public function categoryDelete($id){
        $data=Category::where('id',$id)->first();
    if(isset($data)){
        Category::where('id',$id)->delete();
    return response()->json(["message"=>"deleted success"],200);
    }
    return response()->json(["message"=>"Something wrong here doesn't have that category id "]);
    }

    //create category
    public function categoryCreate(Request $request){
        $data=[
            'name'=>$request->name
        ];
        $response=Category::create($data);
        return response()->json($response, 200);
    }
}
