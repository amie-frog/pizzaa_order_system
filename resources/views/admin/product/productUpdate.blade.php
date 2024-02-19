@extends('admin.layout.master')

@section('content')

   <!-- MAIN CONTENT-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="main-content">
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
                            <h3 class="text-center title-2  fw-bold">Update Pizza</h3>
                        </div>

                        <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                         <div class="row">
                            <div class="col-4 offset-1">
                                <input type="hidden" name="updateId" value="{{$pizza->id}}">

                                <img src="{{asset('storage/'.$pizza->image)}}" alt="" class="img-thumbnail shadow-sm">
                                <div class="mt-2">
                                    <input type="file" name="image" class="form-control @error('image')
                                    is-invalid
                                 @enderror">
                                    @error('image')
                                        <div class="invaild-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror

                              </div>
                              <div class="mt-2 ">
                                <button class="btn bg-dark text-white col-12" type="submit"><i class="fa-solid fa-wrench"></i> Update</button>
                          </div>

                            </div>

                            <div class="row col-6">

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" value="{{old('name',$pizza->name)}}" class="form-control @error('name')
                                        is-invalid
                                     @enderror" aria-required="true" aria-invalid="false" placeholder="enter name..">

                                        @error('name')
                                        <div class="invaild-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Descriptioon</label>
                                        <textarea name="description" id="" cols="10" rows="5" class="form-control @error('description')
                                   is-invalid
                                @enderror" placeholder="enter description..">{{old('description',$pizza->description)}}</textarea>

                                        @error('description')
                                        <div class="invaild-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Category</label>
                                        <select name="category" class="form-control @error('category')
                                   is-invalid
                                @enderror">
                                            <option value="">Choose Category</option>
                                            @foreach ($category as $c)
                                              <option value="{{$c->id}}" @if ($pizza->category_id == $c->id) selected @endif>{{$c->name}}</option>
                                            @endforeach

                                        </select>
                                        @error('category')
                                     <small class="text-danger">{{$message}}</small>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="price" type="price" value="{{old('price',$pizza->price)}}" class="form-control  @error('price')
                                        is-invalid
                                     @enderror" aria-required="true" aria-invalid="false" placeholder="enter price...">


                                        @error('price')
                                        <div class="invaild-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                       </div>

                                       <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                        <input id="cc-pament" name="waitingTime" type="number" value="{{old('waitingTime',$pizza->waiting_time)}}" class="form-control  @error('waitingTime')
                                   is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="enter waiting time...">

                                        @error('waitingTime')
                                        <div class="invaild-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">View Count</label>
                                        <input id="cc-pament" name="viewCount" type="number" value="{{old('viewCount',$pizza->view_count)}}" disabled class="form-control  " aria-required="true" aria-invalid="false">
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1 ">Creaded Date</label>
                                        <input id="cc-pament" name="createdAt" type="text" value="{{$pizza->created_at->format('j-F-Y')}}" class="form-control " aria-required="true" aria-invalid="false" disabled>


                                    </div>
                            </div>
                         </div>
                                </form>

                            </div>
                         </div>

                    </div>
                </div>
            </div>
        </div>


<!-- END MAIN CONTENT-->

@endsection
