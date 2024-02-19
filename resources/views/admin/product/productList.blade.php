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
                            <h2 class="title-1 text-danger">Product List</h2>

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
                <div class="col-4 offset-8">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{session('deleteSuccess')}}
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
                        <form action="{{route('product#listPage')}}" method="get">
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
                            <h3><i class="fa-solid fa-database"></i> {{ $pizzas->total() }} </h3>
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


               @if(count($pizzas) !=0)
               <div class="table-responsive table-responsive-data2 mt-3">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Category</th>
                            <th>View Count</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($pizzas as $p)
                       <tr class="tr-shadow">
                        <td class="col-2"><img src="{{asset('storage/'.$p->image)}}" alt=""  class="img-thumbnail shadow-sm"></td>
                        <td class="col-3">{{$p->name}}</td>
                        <td class="col-2">{{$p->price}}</td>
                        <td class="col-2">{{$p->category_name}}</td>
                        <td class="col-2"><i class="fa-regular fa-eye"></i> {{$p->view_count}}</td>
                        <td class="col-2">
                            <div class="table-data-feature">
                                <a href="{{route('product#edit',$p->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </a>
                                <a href="{{route('product#updatePage',$p->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button></a>
                                <a href="{{route('product#delete',$p->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                       @endforeach
                     </tbody>
                </table>
               <div class="">
                {{$pizzas->appends(request()->query())->links()}}
               </div>

            </div>
               @else
                 <h3 class="text-secondary text-center mt-5">There is no pizza here</h3>
               @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

<!-- END MAIN CONTENT-->
@endsection
