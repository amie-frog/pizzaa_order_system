<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //pizza list
    public function pizzaList(Request $request){
        // Logger($request->status);
        if($request->status=='desc'){
            $data=Product::orderBy('created_at','desc')->get();
        }else{
            $data=Product::orderBy('created_at','asc')->get();
        }

        return $data;
    }

    //add to cart
    public function addToCart(Request $request){
        $data=$this->getPizzaOrder($request);
        Cart::create($data);
        $response=[
            'message'=>'Add to cart Success',
            'status'=>'success'
        ];
         return response()->json($response, 200);
    }

    //increase view count
    public function increaseViewCount(Request $request){
        $order=Product::where('id',$request->pizzaId)->first();
        $viewCount=[
            'view_count'=>$order->view_count +1
        ];
        Product::where('id',$request->pizzaId)->update($viewCount);
        
    }

    //order
    public function order(Request $request){
        $total=0;
        foreach($request->all() as $item){
            $data=OrderList::create([
               'user_id'=>$item['user_id'],
               'product_id'=>$item['product_id'],
               'qty'=>$item['qty'],
               'total'=>$item['total'],
               'order_code'=>$item['order_code']
            ]);
            $total +=$data->total;
        }
        Cart::where('user_id',Auth::user()->id)->delete();
        // logger($total);
        Order::create([
          'user_id'=>Auth::user()->id,
          'order_code'=>$data->order_code,
          'total_price'=>$total+3000
        ]);

        return response()->json([
            'status'=>'true',
            'message'=>'order completed'
        ], 200);
        logger($request->all());
    }

    //cart clear
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();

    }

    //cart clear each  cross btn click
    public function clearBtnCart(Request $request){
        Cart::where('user_id',Auth::user()->id)
              ->where('product_id',$request->productId)
              ->where('id',$request->orderId)
               ->delete();
    }

    //get pizza order count
    private function getPizzaOrder($request){
        return [
              'user_id' =>$request->userId,
              'product_id'=>$request->pizzaId,
              'qty'=>$request->count,
              'created_at'=>Carbon::now(),
              'updated_at'=>Carbon::now(),
        ];
    }
}
