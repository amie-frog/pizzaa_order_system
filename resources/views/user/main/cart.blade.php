@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0 " id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                       @foreach ($cartList as $c)
                       <tr>
                        {{-- <input type="hidden" id="price" value="{{$c->pizza_price}}"> --}}
                        <td><img src="{{asset('storage/'.$c->pizza_image)}}" class="img-thumbnail shadow-sm" width="100px" alt="" ></td>
                        <td class="align-middle"> {{$c->pizza_name}}
                            <input type="hidden" class="orderid" value="{{$c->id}}">
                            <input type="hidden" class="userId" value="{{$c->user_id}}">
                            <input type="hidden" class="productId" value="{{$c->product_id}}">
                        </td>
                        <td class="align-middle" id="price">{{$c->pizza_price}} Kyats</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$c->qty}}" id="qty">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle col-3" id="total">{{$c->pizza_price*$c->qty}} Kyats</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                    </tr>

                       @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subToal">{{$totalPrice}} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotal">{{$totalPrice+ 3000}}  kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 " id="orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3 " id="clearBtn">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    @endsection
@section('scriptSource')
<script>
    $(document).ready(function(){

        
        //when plus btn click
        $('.btn-plus').click(function(){
            $parentNode=$(this).parents("tr");
            $price=$parentNode.find('#price').text().replace("Kyats","");
            $qty=$parentNode.find('#qty').val();

            $total=$price*$qty;

            $parentNode.find('#total').html($total+"Kyats");
            summaryTotalPrice();

        })

        //when minus btn click
        $('.btn-minus').click(function(){
            $parentNode=$(this).parents("tr");
            $price=$parentNode.find('#price').text().replace("Kyats","");
            $qty=$parentNode.find('#qty').val();

            $total=$price*$qty;
            $parentNode.find('#total').html($total+"Kyats");
            summaryTotalPrice();
        })

        //when cross btn click
        $('.btnRemove').click(function(){
            $parentNode=$(this).parents("tr");
            $parentNode.remove();
            summaryTotalPrice();
        })

        //calculate total price
        function summaryTotalPrice(){
            $totalPrice=0;
            $('#dataTable tr').each(function(index,row){
                $totalPrice +=Number($(row).find("#total").text().replace("Kyats",""));
            });
            $("#subToal").html($totalPrice +"Kyats");
            $("#finalTotal").html(`${$totalPrice +3000} Kyats`);
        }
    })
</script>

<script>
    $('#orderBtn').click(function(){
        $orderList=[];
        $random=Math.floor(Math.random() * 100000000001);
        $('#dataTable tbody tr').each(function(index,row){
            $orderList.push({
                'user_id':$(row).find('.userId').val(),
                'product_id':$(row).find('.productId').val(),
                'qty':$(row).find('#qty').val(),
                'total':$(row).find('#total').text().replace('Kyats','')*1,
                'order_code':'POS'+$random
            });
        });
        $.ajax({
            type:'get',
            url:'http://localhost:8000/user/ajax/order',
            data:Object.assign({},$orderList),
            Datatype:'json',
            success:function(response){
                if(response.status=='true'){
                    window.location.href='http://localhost:8000/user/home';
                }
            }

        })



    })
    $('#clearBtn').click(function(){

        $.ajax({
            type:'get',
            url:'http://localhost:8000/user/ajax/clear/cart',
            Datatype:'json',

        })
            $('#dataTable tbody tr').remove();
            $('#subToal').html("0 Kyats");
            $('#finalTotal').html("3000 Kyats");
    })

    //cart clear each  cross btn click
    $('.btnRemove').click(function(){
            $parentNode=$(this).parents("tr");
            $orderId=$parentNode.find('.orderid').val();
            $productId=$parentNode.find('.productId').val();

            $.ajax({
            type:'get',
            url:'http://localhost:8000/user/ajax/clear/btnCart',
            data:{'productId':$productId,'orderId':$orderId},
            Datatype:'json',

        })
            $parentNode.remove();

            $totalPrice=0;
            $('#dataTable tr').each(function(index,row){
                $totalPrice +=Number($(row).find("#total").text().replace("Kyats",""));
            });
            $("#subToal").html($totalPrice +"Kyats");
            $("#finalTotal").html(`${$totalPrice +3000} Kyats`);


        })
</script>
@endsection
