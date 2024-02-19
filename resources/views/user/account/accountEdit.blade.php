@extends('user.layouts.master')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2  fw-bold">Account Profile</h3>
                        </div>

                        @if (session('updateSuccess'))
                        <div class="col-3 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-cloud-arrow-up"></i>  {{session('updateSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                        </div>
                        @endif

                        <form action="{{route('user#accountEdit',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                         <div class="row">
                            <div class="col-4 offset-1">
                                @if (Auth::user()->image==null)
                                    @if (Auth::user()->gender== 'female')
                                        <img src="{{asset('image/female_default.jpg')}}" alt=""  class="img-thumbnail shadow-sm">
                                     @else
                                            <img src="{{asset('image/default.png')}}" alt=""  class="img-thumbnail shadow-sm">
                                     @endif
                               @else
                            <img src="{{asset('storage/' .Auth::user()->image)}}" class="img-thumbnail shadow-sm" />
                           @endif
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

                            <div class="col-6">

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" value="{{old('name',Auth::user()->name)}}" class="form-control @error('name')
                                        is-invalid
                                     @enderror" aria-required="true" aria-invalid="false" placeholder="enter name..">

                                        @error('name')
                                        <div class="invaild-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror

                                        @if (session('notmatch'))
                                        <div class="invaild-feedback">
                                            {{session('notmatch')}}
                                        </div>

                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="text" value="{{old('email',Auth::user()->email)}}" class="form-control  @error('email')
                                   is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="enter email@,com...">

                                        @error('email')
                                        <div class="invaild-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror

                                        @if (session('notmatch'))
                                        <div class="invaild-feedback">
                                            {{session('notmatch')}}
                                        </div>

                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Phone No</label>
                                        <input id="cc-pament" name="phone" type="text" value="{{old('phone',Auth::user()->phone)}}" class="form-control  @error('phone')
                                   is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="09-123456789...">

                                        @error('phone')
                                        <div class="invaild-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror

                                        @if (session('notmatch'))
                                        <div class="invaild-feedback">
                                            {{session('notmatch')}}
                                        </div>

                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Address</label>
                                        <textarea name="address" id="" cols="30" rows="10" class="form-control @error('address')
                                   is-invalid
                                @enderror">{{old('address',Auth::user()->address)}}</textarea>

                                        @error('address')
                                        <div class="invaild-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror

                                        @if (session('notmatch'))
                                        <div class="invaild-feedback">
                                            {{session('notmatch')}}
                                        </div>

                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control @error('gender')
                                   is-invalid
                                @enderror">
                                            <option value="">Choose your gender</option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected  @endif>Female</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected  @endif>Male</option>
                                        </select>
                                    </div>
                                    @error('gender')
                                     <small class="text-danger">{{$message}}</small>
                                    @enderror
                                    @if (session('notmatch'))
                                    <div class="invaild-feedback">
                                        {{session('notmatch')}}
                                    </div>

                                    @endif
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1 ">Role</label>
                                        <input id="cc-pament" name="" type="text" value="{{Auth::user()->role}}" class="form-control " aria-required="true" aria-invalid="false" disabled>


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