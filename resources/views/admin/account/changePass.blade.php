@extends('admin.layout.master')

@section('content')

   <!-- MAIN CONTENT-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Your Password</h3>
                        </div>
                        @if (session('changed'))
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-xmark"></i>  {{session('changed')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                        </div>
                        @endif
                        @if (session('notmatch'))
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-xmark"></i>  {{session('notmatch')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                        </div>
                        @endif
                        <hr>
                        <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password" value="{{old('oldPassword')}}" class="form-control " aria-required="true" aria-invalid="false" placeholder="enter your old password...">

                                @error('oldPassword')
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
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password" value="{{old('newPassword')}}" class="form-control  @if (session('notmatch'))
                                is-invalid
                                @endif @error('newPassword')
                                   is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="enter your new password...">
                                @error('newPassword')
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
                                <label for="cc-payment" class="control-label mb-1">Comfirm Password</label>
                                <input id="cc-pament" name="comfirmPassword" type="password" value="{{old('comfirmPassword')}}" class="form-control  @if (session('notmatch'))
                                is-invalid
                                @endif @error('comfirmPassword')
                                   is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="comfirm your new password...">
                                @error('comfirmPassword')
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

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa-solid fa-key"></i> <span id="payment-button-amount">Change Password</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}

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
