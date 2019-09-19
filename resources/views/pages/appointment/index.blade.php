@extends('layouts.app')
@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="main-panel">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <div class="brand-logo text-center">
                                    <img src="{{asset('public/amalitechLogo.png')}}" alt="logo">
                                    <h4 class="display-5">SCHEDULE MASTER</h4>
                                </div>
                                {{--<div class="text-center">
                                    <h6>Sign in</h6>
                                </div>--}}
                                <form class="pt-2" method="get" action="{{ route('confirm-email') }}">
                                    @csrf
                                    <div class="form-group row text-center text-danger">
                                        <div class="col-md-12">
                                            Please Confirm your Email
                                        </div>
                                        <input id="email" type="email" placeholder="Email Address" class="form-control mb-2  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @include('layouts.messages')
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-block btn-primary  font-weight-medium" >Confirm Email</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
