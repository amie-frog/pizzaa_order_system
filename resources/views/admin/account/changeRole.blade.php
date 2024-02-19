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
                              <a href="">
                            <i class="fa-solid fa-arrow-left text-black" onclick="history.back()"></i>
                           </a>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2  fw-bold">Change Role</h3>
                        </div>


                        <form action="{{route('admin#changeRoleFun',$account->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                         <div class="row">
                            <div class="col-4 offset-1">
                                @if ($account->image==null)
                                    @if ($account->gender== 'female')
                                        <img src="{{asset('image/female_default.jpg')}}" alt=""  class="img-thumbnail shadow-sm">
                                     @else
                                            <img src="{{asset('image/default.png')}}" alt=""  class="img-thumbnail shadow-sm">
                                     @endif
                               @else
                            <img src="{{asset('storage/' .$account->image)}}" />
                           @endif

                              <div class="mt-2 ">
                                <button class="btn bg-dark text-white col-12" type="submit"><i class="fa-solid fa-wrench"></i> Change</button>
                          </div>

                            </div>

                            <div class=" row col-6">

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name"  disabled type="text" value="{{old('name',$account->name)}}" class="form-control @error('name')
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
                                        <label for="cc-payment" class="control-label mb-1 ">Role</label>
                                        <select name="role" class="form-control">
                                            <option value="admin" @if ($account->role== 'admin') selected @endif>Admin</option>
                                            <option value="user" @if ($account->role== 'user') selected @endif>User</option>
                                        </select>


                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" disabled type="text" value="{{old('email',$account->email)}}" class="form-control  @error('email')
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
                                        <input id="cc-pament" name="phone" disabled type="text" value="{{old('phone',$account->phone)}}" class="form-control  @error('phone')
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
                                        <textarea name="address" id="" disabled cols="30" rows="10" class="form-control @error('address')
                                   is-invalid
                                @enderror">{{old('address',$account->address)}}</textarea>

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
                                        <select name="gender" disabled class="form-control @error('gender')
                                   is-invalid
                                @enderror">
                                            <option value="">Choose your gender</option>
                                            <option value="female" @if ($account->gender == 'female') selected  @endif>Female</option>
                                            <option value="male" @if ($account->gender == 'male') selected  @endif>Male</option>
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
