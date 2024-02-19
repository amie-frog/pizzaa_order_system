@extends('user.layouts.master')
@section('content')
  <div class="row">
    <div class="col-6 offset-3 ">
        <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Your Password</h3>
                        </div>
                        @if (session('changed'))
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-cloud-arrow-up"></i>  {{session('changed')}}
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
                        <form action="{{route('user#changePassword')}}" method="post" novalidate="novalidate">
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
                                <button id="payment-button" type="submit" class="btn btn-lg bg-dark text-white btn-block">
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
    </div>
  </div>
@endsection
