@extends('admin.layout.master')

@section('content')

   <!-- MAIN CONTENT-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('product#listPage')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Product</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="name" type="text" value="{{old('name')}}" class="form-control @error('name')
                                   is-invalid
                                @enderror " aria-required="true" aria-invalid="false" placeholder="pizza name...">
                                @error('name')
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
                                 @foreach ($categories as $c)
                                 <option value="{{$c->id}}">{{$c->name}}</option>
                                 @endforeach
                               </select>
                               @error('category')
                                <div class="invaild-feedback">
                                    {{$message}}
                                </div>

                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Description</label>
                              <textarea name="description" class="form-control @error('description')
                                   is-invalid
                                @enderror" cols="30" rows="10" placeholder="enter description...">{{old('description')}}</textarea>
                                @error('description')
                                <div class="invaild-feedback">
                                    {{$message}}
                                </div>

                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Image</label>
                               <input type="file" name="image" class="form-control @error('image')
                                   is-invalid
                                @enderror">
                                @error('image')
                                <div class="invaild-feedback">
                                    {{$message}}
                                </div>

                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                <input id="cc-pament" name="waitingTime" type="number" value="{{old('waitingTime')}}" class="form-control @error('waitingTime')
                                   is-invalid
                                @enderror " aria-required="true" aria-invalid="false" placeholder="waiting time...">
                                @error('waitingTime')
                                <div class="invaild-feedback">
                                    {{$message}}
                                </div>

                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="price" type="text" value="{{old('price')}}" class="form-control @error('price')
                                   is-invalid
                                @enderror " aria-required="true" aria-invalid="false" placeholder="enter price...">
                                @error('price')
                                <div class="invaild-feedback">
                                    {{$message}}
                                </div>

                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
@endsection
