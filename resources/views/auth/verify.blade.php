@extends('layouts.app')

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="main-panel">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto ">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <div class="brand-logo text-center">
                                    <img src="{{asset('public/amalitech.png')}}" alt="logo">
                                    <h4 class="display-5">Verify Your Email Address</h4>
                                </div>
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                                <form class="text-center" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    {{ __('Did\'nt receive any email?') }}  <br>
                                    <button type="submit" class="btn btn-primary m-0 align-baseline">{{ __('Resend') }}</button>.
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
