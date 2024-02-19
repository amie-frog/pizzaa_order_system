@extends('admin.layout.master')

@section('content')

   <!-- MAIN CONTENT-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="main-content">
    <div class="row">
        <col-3 class="col-3 offset-7  mb-2">
            @if (session('updateSuccess'))
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{session('updateSuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
        </col-3>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-5">

                            <i class="fa-solid fa-arrow-left text-black" onclick="history.back()"></i>
                           </a>
                        </div>
                        <div class="card-title">
                            {{-- <h3 class="text-center title-2">Product Detail</h3> --}}
                        </div>


                       <div class="row ">
                          <div class="col-3 offset-2">
                            <img src="{{asset('storage/' .$pizza->image)}}"  class="img-thumbnail shadow-sm"/>
                          </div>
                          <div class="col-7">
                            <h3 class="my-3 text-decoration-underline "> {{$pizza->name}}</h3>
                            <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-hourglass-start"></i> {{$pizza->waiting_time}}</span>
                            <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-money-bill"></i> {{$pizza->price}}</span>
                            <span class="my-3 btn btn-dark text-white"><i class="fa-regular fa-eye"></i> {{$pizza->view_count}}</span>
                            <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-link"></i>{{$pizza->category_name}}</span>
                            <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-clock"></i> {{$pizza->created_at->format('j-F-Y')}}</span>
                            <div class="my-3"><i class="fa-solid fa-file-lines"></i>Detail</div>
                            <div> {{$pizza->description}}</div>
                           </div>
                       </div>
                       <div class="row">
                         <div class="col-4 offset-2 mt-3">
                           <a href="{{route('product#updatePage',$pizza->id)}}">
                            <button class="btn bg-dark text-white" >
                                <i class="fa-solid fa-user-pen me-2"></i> Edit Pizza
                            </button>
                           </a>
                         </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
@endsection
