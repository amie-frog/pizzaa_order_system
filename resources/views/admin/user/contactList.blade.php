@extends('admin.layout.master')

@section('content')
   <!-- MAIN CONTENT-->

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            @if (session('deleteSuccess'))
            <div class="col-3 offset-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-cloud-arrow-up"></i>  {{session('deleteSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
            @endif
            <div class="col-md-12">

               <div class="table-responsive table-responsive-data2 mt-3">
                <table class="table table-data2 text-center" id="dataList">
                    <thead>
                        <tr>


                            <th>User Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($data as $d)
                       <tr class="tr-shadow">

                        <td class="">{{$d->name}}</td>
                        <td class="">{{$d->email}}</td>
                        <td class="">{{$d->message}}</td>
                        <td class="">{{$d->created_at->format('F-j-Y')}}</td>
                        <td>
                            <a href="{{route('admin#contactDelete',$d->id)}}">
                            <button class="item " data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                        </a>
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
