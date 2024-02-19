@extends('admin.layout.master')

@section('content')
   <!-- MAIN CONTENT-->

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
               <div class="table-responsive table-responsive-data2 ">
                <a href="{{route('admin#orderList')}}" class="text-dark"><i class="fa-solid fa-arrow-left-long"></i>Back</a>

                <div class="row col-7 " >
                    <div class="card col-8 mt-4" >
                        <div class="card-body">
                            <h3><i class="fa-solid fa-clipboard me-3"></i> Order Info</h3>
                            <span class="text-warning"><i class="fa-solid fa-triangle-exclamation"></i> Include Delivery Charges</span>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col "><i class="fa-regular fa-user"></i>Name</div>
                                <div class="col"> {{strtoupper($orderList[0]->user_name)}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col "><i class="fa-solid fa-barcode"></i>Order Code</div>
                                <div class="col"> {{$orderList[0]->order_code}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col "><i class="fa-regular fa-clock"></i>Order Date</div>
                                <div class="col"> {{$orderList[0]->created_at->format('F-j-Y')}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col "><i class="fa-solid fa-money-bill-wave me-3"></i>Total</div>
                                <div class="col"> {{$order->total_price}} Kyats</div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-data2 text-center" id="dataList">
                    <thead>
                        <tr>
                             <th></th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Order Date</th>
                            <th>Qty</th>
                            <th>Amount</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderList as $o)
                        <tr class="tr-shadow">
                        <td></td>
                         <td class="">{{$o->user_id}}</td>
                         <td class="">{{$o->user_name}}</td>
                         <td class="col-2"><img src="{{asset('storage/'.$o->product_image)}}" alt=""  class="img-thumbnail shadow-sm"></td>
                         <td>{{$o->product_name}}</td>
                         <td class="">{{$o->created_at->format('F-j-Y')}}</td>
                         <td>{{$o->qty}}</td>
                         <td class="amount">{{$o->total}} Kyats</td>

                     </tr>
                        @endforeach
                     </tbody>
                </table>
               <div class="">
                {{-- {{$order->links()}} --}}
               </div>

            </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

<!-- END MAIN CONTENT-->
@endsection
