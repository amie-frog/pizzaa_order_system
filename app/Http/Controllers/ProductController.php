<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function listPage(){
        $pizzas=Product::select('products.*','categories.name as category_name')
         ->when(request('key'),function($query){

            $query->where('products.name','like','%'.request('key'). '%');
        })
                        ->leftJoin('categories','products.category_id','categories.id')
                          -> orderBy('products.created_at','desc')->paginate(3);
        // $pizzas=appends(request()->all());
        return view('admin.product.productList',compact('pizzas'));
    }

    // direct product createPage
    public function createPage(){
        $categories=Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    //product delete
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#listPage')->with(['deleteSuccess'=>' Product Deleted successfully...']);
    }

    //product detail page
    public function edit($id){
        $pizza=Product::select('products.*','categories.name as category_name')
        ->join('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.productDetail',compact('pizza'));
    }

    //product updatePage
    public function updatePage($id){
        $pizza=Product::where('id',$id)->first();
        $category=Category::get();
        return view('admin.product.productUpdate',compact('pizza','category'));
    }

    //product create
    public function productCreate(Request $request){
        $this->checkValidationForProduct($request,"create");
        $data=$this->getProductData($request);

        //for image
        if($request->hasFile('image')){
            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }

        Product::create($data);
        return redirect()->route('product#listPage');
    }

    //product update function
    public function update(Request $request){
        $this->checkValidationForProduct($request,"update");
        $data=$this->getProductData($request);

        //get image from form
        if($request->hasFile('image')){
            $oldImageName=Product::where('id',$request->updateId)->first();
            $oldImageName=$oldImageName->image;

            //delete image from pj
           if($oldImageName!=null){
             Storage::delete('public/'.$oldImageName);
           }

           //give image name and store in pj,db
           $fileName=uniqid().$request->file('image')->getClientOriginalName();
           $request->file('image')->storeAs('public',$fileName);
           $data['image']=$fileName;
        }
        Product::where('id',$request->updateId)->update($data);
        return redirect()->route('product#listPage');
    }

    //get product data
    private function getProductData($request){
        return[
            'category_id'=>$request->category,
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
             'waiting_time'=>$request->waitingTime,

        ];
    }

    //validation check for product
    private function checkValidationForProduct($request,$action){
        $validationRule=[
            'name'=>'required|unique:products,name,'.$request->updateId,
            'category'=>'required',
            'description'=>'required',
            'price'=>'required',
            'waitingTime'=>'required'
        ];
        $validationRule['image']= $action =="create" ? 'required|mimes:png,jpg,jpeg|file' : 'mimes:png,jpg,jpeg|file';

        Validator::make($request->all(),$validationRule)->validate();
    }
}
