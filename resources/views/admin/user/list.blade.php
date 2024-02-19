@extends('admin.layout.master')

@section('content')
   <!-- MAIN CONTENT-->

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row my-2">
                    <div class="col-2 bg-white text-center shadow-sm p-2 my-1">
                        <i class="fa-solid fa-database"></i> Total {{ count($user) }}
                    </div>
                </div>



               <div class="table-responsive table-responsive-data2 mt-3">
                <table class="table table-data2 text-center" id="dataList">
                    <thead>
                        <tr>

                            <th> Image</th>
                            <th> Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($user as $u)
                       <tr class="tr-shadow">
                        <td class="col-2">
                            @if ($u->image==null)
                            @if ($u->gender== 'female')
                                <img src="{{asset('image/female_default.jpg')}}" alt=""  class="img-thumbnail shadow-sm">
                             @else
                                    <img src="{{asset('image/default.png')}}" alt=""  class="img-thumbnail shadow-sm">
                             @endif
                       @else
                    <img src="{{asset('storage/' .$u->image)}}" class="img-thumbnail shadow-sm" />
                   @endif
                        </td>
                        <input type="hidden" id="userId" value="{{$u->id}}">
                        <td>{{$u->name}}</td>
                        <td>{{$u->email}}</td>
                        <td>{{$u->gender}}</td>
                        <td>{{$u->phone}}</td>
                        <td>{{$u->address}}</td>
                        <td>
                             <select name="" id="" class="form-control changeRole">
                                <option value="admin" @if ($u->role == 'admin') selected   @endif>Admin</option>
                                <option value="user" @if ($u->role == 'user') selected @endif>User</option>
                             </select>
                        </td>
                        <td class="">
                            <div class="table-data-feature">

                                <a href="{{route('admin#userListEditPage',$u->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button></a>
                                <a href="{{route('admin#userListDelete',$u->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>

                            </div>
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

    $('.changeRole').change(function(){
            $currentState=$(this).val();
            $parentNode=$(this).parents("tr");
            $userId=$parentNode.find('#userId').val();

            $data={
                'role':$currentState,
                'userId':$userId,
            };


            $.ajax({
            type:'get',
            url: '/user/role/change',
            data:$data,
            Datatype:'json',

        })
        location.reload();
    })

    })
</script>

@endsection
