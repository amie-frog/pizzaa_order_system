@extends('admin.layout.master')

@section('content')
   <!-- MAIN CONTENT-->

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">




                {{-- search --}}

                <form action="{{route('admin#changeStatus')}}" method="get" class="col-3">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text">
                               <i class="fa-solid fa-database me-3"></i>{{count($order)}}
                            </span>
                          </div>
                        <select id="inputGroupSelect02" class="custom-select orderStatus" name="orderStatus">
                            <option value="" >All</option>
                            <option value="0" @if(request('orderStatus')=='0') selected @endif>Pending</option>
                            <option value="1" @if(request('orderStatus')=='1') selected @endif>Accept</option>
                            <option value="2" @if(request('orderStatus')=='2') selected @endif>Reject</option>
                          </select>
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-sm ms-3 bg-dark text-white input-group-text"><i class="fa-solid fa-magnifying-glass me-3"></i> Search</button>
                          </div>
                     </div>
                </form>







               <div class="table-responsive table-responsive-data2 mt-3">
                <table class="table table-data2 text-center" id="dataList">
                    <thead>
                        <tr>

                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Order Date</th>
                            <th>Order Code</th>
                            <th>Amount</th>
                            <th>Status</th>


                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($order as $o)
                       <tr class="tr-shadow">


                         <input type="hidden" value="{{$o->id}}" id="orderId">
                        <td class="">{{$o->user_id}}</td>
                        <td class="">{{$o->user_name}}</td>
                        <td class="">{{$o->created_at->format('F-j-Y')}}</td>
                        <td class="">
                            <a href="{{route('admin#orderListInfo',$o->order_code)}}">
                                {{$o->order_code}}
                            </a>
                        </td>
                        <td class="amount">{{$o->total_price}} Kyats</td>
                        <td class="">
                              <select name="status" id="" class="form-control statusChange">
                                <option value="" >All</option>
                                <option value="0" @if ($o->status == 0) selected @endif>Pending</option>
                                <option value="1" @if ($o->status == 1) selected @endif>Accept</option>
                                <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                              </select>
                        </td>
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
@section('scriptSource')
<script>
    $(document).ready(function(){
        // $('#orderStatus').change(function(){
        //     $status=$('#orderStatus').val();
        //     $.ajax({
        //     type:'get',
        //     url:'http://localhost:8000/order/ajax/status',
        //     data:{'status':$status},
        //     Datatype:'json',
        //     success:function(response){
        //         $list='';
        //        for($i=0;$i<response.length;$i++){

        //         $months=['January','February','March','April','May','June','July','August','September','October','November','December'];
        //         $dbDate= new Date(response[$i].created_at);
        //         $finalDate=$months[$dbDate.getMonth()]+"-"+$dbDate.getDate() +"-"+$dbDate.getFullYear();

        //        if (response[$i].status == 0){
        //         $statusMessage=`
        //             <select name="status" id="" class="form-control statusChange">
        //                 <option value=""  >All</option>
        //                 <option value="0" selected >Pending</option>
        //                 <option value="1" >Accept</option>
        //                  <option value="2" >Reject</option>
        //             </select>`;
        //        }

        //        else if (response[$i].status == 1) {
        //         $statusMessage=`
        //             <select name="status" id="" class="form-control statusChange">
        //                 <option value=""  >All</option>
        //                 <option value="0" selected >Pending</option>
        //                 <option value="1" selected >Accept</option>
        //                  <option value="2" >Reject</option>
        //             </select>`;
        //        }
        //        else if (response[$i].status == 2) {
        //         $statusMessage=`
        //             <select name="status" id="" class="form-control statusChange">
        //                 <option value=""  >All</option>
        //                 <option value="0"  >Pending</option>
        //                 <option value="1" >Accept</option>
        //                  <option value="2" selected>Reject</option>
        //             </select>`;
        //        }



        //         $list+=`
        //         <tr class="tr-shadow">
        //             <input type="hidden" value="${response[$i].id}" id="orderId">
        //                 <td class="">${response[$i].user_id}</td>
        //                 <td class="">${response[$i].user_name}</td>
        //                 <td class="">${$finalDate}</td>
        //                 <td class="">${response[$i].order_code}</td>
        //                 <td class="">${response[$i].total_price}</td>
        //                 <td class="">${$statusMessage}</td>
        //             </tr>
        //         `;
        //        }
        //        $('#dataList').html($list);
        //     }

        // })
        // })

        //change status
        $('.statusChange').change(function(){
            $currentState=$(this).val();
            $parentNode=$(this).parents("tr");

            $orderId=$parentNode.find('#orderId').val();


            $data={
                'status':$currentState,
                'id':$orderId,
            };
          
            $.ajax({
            type:'get',
            url:'/order/ajax/change/status',
            data:$data,
            Datatype:'json',

        })
        })
    })
</script>

@endsection
