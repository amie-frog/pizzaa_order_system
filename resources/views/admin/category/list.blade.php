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
                            <h2 class="title-1 text-danger">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category#create')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add item
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                {{-- search --}}
                <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary">Search Key: <span class="text-danger">{{request('key')}}</span> </h4>
                    </div>
                    <div class="col-3 offset-6 ">
                        <form action="{{route('category#list')}}" method="get">
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
                            <h3><i class="fa-solid fa-database"></i> {{ $categories->total() }} </h3>
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

                {{-- alert box for delete --}}
                @if (session('categoryDelete'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-xmark"></i>  {{session('categoryDelete')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
               @if (count($categories) != 0)
               <div class="table-responsive table-responsive-data2 mt-3">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Created Date</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($categories as $category)
                       <tr class="tr-shadow">
                        <td>{{$category->id}}</td>
                        <td class="col-6">{{$category->name}}</td>

                        <td>{{$category->created_at->format('j-F-Y')}}</td>
                        <td>
                            <div class="table-data-feature">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                                <a href="{{route('category#edit',$category->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button></a>
                                <a href="{{route('category#delete',$category->id)}}">
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
                {{$categories->appends(request()->query())->links()}}
               </div>

            </div>
               @else
                 <h3 class="text-secondary text-center mt-5">There is no category here</h3>
               @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

<!-- END MAIN CONTENT-->
@endsection
