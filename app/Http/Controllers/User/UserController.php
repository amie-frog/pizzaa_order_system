<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home
    public function home(){
        $pizza=Product::orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }
    public function passwordChangePage(){
        return view('user.account.change');
    }

    //filter
    public function filter($categoryId){
        $pizza=Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //pizza detail
    public function pizzaDetail($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList=Product::get();

        return view('user.main.detail',compact('pizza','pizzaList'));
    }

    //cart list page
    public function cartList(){
        $cartList=Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
                       ->leftJoin('products','products.id','carts.product_id')
                       ->where('carts.user_id',Auth::user()->id)
                       ->get();

        $totalPrice=0;
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price*$c->qty;
        }

        return view('user.main.cart',compact('cartList','totalPrice'));
    }



    //cart history page
    public function cartHistory(){
        $order=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('6');
        return view('user.main.cartHistory',compact('order'));
    }

    //password Change
    public function passwordChange(Request $request){
         $this->passwordValidationCheck($request);
        $user=User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword=$user->password;
        if(Hash::check($request->oldPassword,$dbPassword)){
            $data=[
                'password'=>Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            // Auth::logout();

            return back()->with(['changed'=>'your password changed successfully!!']);
        }
        return back()->with(['notmatch'=>'The old is not correct please try again']);
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
          'oldPassword'=>'required|min:6',
          'newPassword'=>'required|min:6',
          'comfirmPassword'=>'required|min:6|same:newPassword',
        ])->validate();
    }

    //account detail page
    public function accountDetailPage(Request $request){
        return view('user.account.accountEdit');
    }


    //update account profile
    public function accountEdit(Request $request,$id){
        $this->checkUserData($request);
         $data=$this->getUserData($request);

         //for image upload
         if($request->hasFile('image')){
             $dbImage=User::where('id',$id)->first();
             $dbImage=$dbImage->image;

             //image delete from database for duplicate
              if($dbImage !=null){
                 Storage::delete('public/'.$dbImage);
              }


             // image store in database
             $fileName=uniqid() . $request->file('image')->getClientOriginalName();
             $request->file('image')->storeAs('public',$fileName);
             $data['image']=$fileName;

         }
         User::where('id',$id)->update($data);
         return back()->with(['updateSuccess'=>'Account updated successfully...']);

     }

     //user account list control from admin
     public function userList(){
        $user=User::where('role','user')->get();
        return view('admin.user.list',compact('user'));
     }


     //user account change role from admin
     public function changeRole(Request $request){
       User::where('id',$request->userId)->update([
        'role'=>$request->role
       ]);
     }

     //user data validation
    private function checkUserData($request){
        validator::make($request->all(),[
             'name'=>'required',
             'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'image'=>'mimes:png,jpg|file',

        ])->validate();
    }
     //get user data
     private function getUserData($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender,
            'updated_at'=>Carbon::now()

        ];
    }
}
