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

                                <div class="accordion " id="accordion-2" role="tablist">
                                    <div id="collapse-4" class="collapse bg-transparent" role="tabpanel" aria-labelledby="heading-4" data-parent="#accordion-2">
                                        <form class="pt-2" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input id="email" type="email" placeholder="Email Address" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="mt-3">
                                                <button class="btn btn-block btn-primary  font-weight-medium" >SIGN IN</button>
                                            </div>
                                            <div class="my-2 d-flex justify-content-between align-items-center">
                                                <div class="form-check">
                                                    <label class="form-check-label text-muted">
                                                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        Keep me signed in
                                                    </label>
                                                </div>
                                                @if (Route::has('password.request'))
                                                    <a class="auth-link text-black" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Password?') }}
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <a class="collapsed" data-toggle="collapse" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                                    Book Appointment
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="collapse-5" class="collapse show" role="tabpanel" aria-labelledby="heading-5" data-parent="#accordion-2">
                                        <form class="pt-2" method="POST" action="{{route('login')}}">
                                            @csrf
                                            <div class="form-group row text-center text-danger">
                                                <div class="col-md-12">
                                                    <label for="email">Please Confirm your Email</label>
                                                    <input id="email" type="email" placeholder="Email Address" class="form-control mb-2  @error('email') is-invalid @enderror candidate-mail" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                    <input id="password" hidden placeholder="Password" type="text" class="form-control @error('password') is-invalid @enderror candidate-pass" name="password" required autocomplete="current-password">
                                                </div>
                                                @include('layouts.messages')
                                            </div>
                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-block btn-primary  font-weight-medium" >Confirm Email</button>
                                            </div>
                                        </form>

                                        <a data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                            Login
                                        </a>
                                    </div>
                                </div>
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
