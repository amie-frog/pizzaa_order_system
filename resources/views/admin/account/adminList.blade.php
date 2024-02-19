@extends('admin.layout.master')

@section('content')
   <!-- MAIN CONTENT-->

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1 text-danger">Admin List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('product#create')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add item
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                {{-- alert box for delete --}}
                @if (session('deleteSuccess'))
                        <div class="">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-xmark"></i>  {{session('deleteSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                        </div>
                @endif
                {{-- search --}}
                <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary">Search Key: <span class="text-danger">{{request('key')}}</span> </h4>
                    </div>
                    <div class="col-3 offset-6 ">
                        <form action="{{route('admin#list')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" class="form-control" placeholder="Search here..." name="key" value="{{request('key')}}">
                            <button class="btn bg-dark text-white" type="submit">
                                <i class="fa-brands fa-searchengin"></i>
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
                    <div class="row my-2">
                        <div class="col-1 bg-white text-center shadow-sm p-2 my-1">
                            <h3><i class="fa-solid fa-database"></i> {{ $admin->total() }} </h3>
                        </div>
                    </div>



                {{-- @if (session('categoryCrate'))
                <div class="col-4 offset-8 ">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i>  {{session('categoryCrate')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif --}}


               {{-- @if(count($pizzas) !=0) --}}
               <div class="table-responsive table-responsive-data2 mt-3">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Admin Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($admin as $a)
                       <tr class="tr-shadow">

                        <td class="col-2">
                            @if ($a->image==null)
                              @if ($a->gender== 'female')
                              <img src="{{asset('image/female_default.jpg')}}" alt=""  class="img-thumbnail shadow-sm">
                                @else
                                <img src="{{asset('image/default.png')}}" alt=""  class="img-thumbnail shadow-sm">
                              @endif
                            @else
                            <img src="{{asset('storage/'.$a->image)}}" alt=""  class="img-thumbnail shadow-sm">
                            @endif
                        </td>
                        <input type="hidden" value="{{$a->id}}" id="adminId">
                        <td class="col-3">{{$a->name}}</td>
                        <td class="col-2">{{$a->email}}</td>
                        <td class="col-2">{{$a->phone}}</td>
                        <td class="col-2"> {{$a->address}}</td>
                        <td class="col-2"> {{$a->gender}}</td>
                        <td class="col-2">
                            @if (Auth::user()->id ==$a->id)

                            @else
                            <select name="role" id="" class="form-control changeRole">
                            <option value="" >All</option>
                            <option value="admin"  @if ($a->role == 'admin') selected   @endif>Admin</option>
                            <option value="user"  @if ($a->role == 'user') selected   @endif>User</option>

                          </select>
                          @endif
                        </td>
                        <td>
                            <div class="table-data-feature">
                                @if (Auth::user()->id ==$a->id)

                                @else
                                <a href="{{route('admin#changeRole',$a->id)}}">
                                    <button class="item me-5 changeRole" data-toggle="tooltip" data-placement="top" title="Change role">
                                        <i class="fa-solid fa-person-circle-minus"></i>

                                    </button>
                                </a>
                                <a href="{{route('admin#delete',$a->id)}}">
                                    <button class="item " data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>
                                @endif
                            </div>
                        </td>

                    </tr>
                       @endforeach
                     </tbody>
                </table>
               <div class="">
                {{$admin->links() }}
               </div>

            </div>
               {{-- @else
                 <h3 class="text-secondary text-center mt-5">There is no pizza here</h3>
               @endif --}}
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
            $adminId=$parentNode.find('#adminId').val();

            $data={
                'role':$currentState,
                'adminId':$adminId,
            };

            $.ajax({
            type:'get',
            url:'/admin/ajax/change/role',
            data:$data,
            Datatype:'json',

        })
        location.reload();
    })

    })
</script>

@endsection