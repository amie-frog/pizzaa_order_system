<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //list
    public function list(){
        // return view('admin.category.list');
        $categories=Category::when(request('key'),function($query){
                             $query->where('name','like','%'. request('key') .'%');
        })

                            ->orderBy('id','desc')->paginate(4);
        return view('admin.category.list',compact('categories'));
    }

    //redirect category create list
    public function categoryCreatePage(){
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data=$this->createCategory($request);
        Category::create($data);
        return redirect()->route('category#list');
    }
     //delete category
     public function delete($id){
       Category::where('id',$id)->delete();
       return back()->with(['categoryDelete'=>'Deleted Category Successfully!!']);
     }

     //edit category
     public function edit($id){
        $categoryEdit=Category::where('id',$id)->first();

        return view('admin.category.edit',compact('categoryEdit'));
     }


     //update
     public function update($id,Request $request){
        $this->categoryValidationCheck($request);
        $data=$this->createCategory($request);

        Category::where('id',$id)->update($data);
        return redirect()->route('category#list');
     }

    //Category Validation Check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName'=>'required|unique:categories,name,'.$request->categoryId
        ])->validate();
    }
    //create category database
    private function createCategory($request){
        return[
          'name'=>$request->categoryName,
        ];
    }
}
