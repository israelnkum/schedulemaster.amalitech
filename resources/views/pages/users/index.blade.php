@extends('layouts.dash')

@section('dash-content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6 mb-4 mb-xl-0">
                        <h3>All Users</h3>
                    </div>
                </div>
                <div class="page-header-tab mt-xl-4">
                    <div class="col-12 pl-0 pr-0">
                        <div class="row ">
                            <div class="col-12 col-sm-6 mb-xs-4  pt-2 pb-2 mb-xl-0">

                            </div>
                            <div class="col-12 col-sm-6 mb-xs-4 mb-xl-0 pt-2 pb-2 text-md-right d-none d-md-block">
                                <div class="d-inline-flex">
                                    <button data-toggle="modal" data-target="#deleteStaff" id="deleteSelected" disabled class="btn text-danger d-flex align-items-center">
                                        <i class="mdi mdi-trash-can mr-1"></i>
                                        <span class="text-left font-weight-medium">
                            Delete
                            </span>
                                    </button>
                                    <button class="btn d-flex align-items-center">
                                        <i class="mdi mdi-file-pdf  mr-1"></i>
                                        <span class="font-weight-medium text-left">
                            Export
                            </span>
                                    </button>
                                    <button class="btn d-flex align-items-center pr-0">
                                        <i class="mdi mdi-email-outline  mr-1"></i>
                                        <span class="text-left font-weight-medium">
                            Send as Email
                            </span>
                                    </button>
                                    <button class="btn d-flex align-items-center pr-0" data-toggle="modal" data-target="#new-user-modal">
                                        <i class="mdi mdi-account  mr-1"></i>
                                        <span class="text-left font-weight-medium">
                            New User
                            </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content tab-transparent-content pb-0">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('bulk_delete')}}" id="bulkDeleteForm" method="POST">
                                        @csrf
                                        <div class="table-responsive">`
                                            <table id="users_table" class="table">
                                                <thead>
                                                <tr>
                                                    <th class="pl-0">
                                                        <div class="form-check mb-0">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" id="checkAll" class="form-check-input">
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                    </th>
                                                    <th>#</th>
                                                    <th>Profile</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    {{--                                                <th>Status</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 1)
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td class="pl-0">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" value="{{$user->id}}" class="form-check-input checkItem" name="selected_id[]">
                                                                    <i class="input-helper"></i></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{$i}}
                                                        </td>
                                                        <td>
                                                            <img src="{{asset('public/p_imgs/'.$user->profile_image)}}" alt="image" class="rounded-circle mr-2">
                                                        </td>
                                                        <td>
                                                            <div class="text-muted font-weight-medium">{{$user->name}}</div>
                                                        </td>
                                                        <td>
                                                            <div class="text-muted font-weight-medium">{{$user->email}}</div>
                                                        </td>
                                                        {{--<td>Verified
                                                            <form class="text-center" method="POST" action="{{ route('verification.resend') }}">
                                                                @csrf
                                                                {{ __('Did\'nt receive any email?') }}  <br>
                                                                <button type="submit" class="btn btn-primary m-0 align-baseline">{{ __('Resend') }}</button>.
                                                            </form></td>--}}
                                                    </tr>
                                                    @php($i++)
                                                @endforeach

                                                </tbody>
                                            </table>
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


    <div class="modal fade" id="new-user-modal" tabindex="-1" role="dialog" aria-labelledby="new-user-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="name" type="text" placeholder="Full Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{--<div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Ends -->

    <div class="modal fade" id="deleteStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Staff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <p>Are you want to delete selected staff</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="icon icon-close"></i> Close
                    </button>
                    <button type="submit" id="btn_submit_bulk_delete" class="btn btn-success">
                        <i class="icon icon-trash"></i> Yes! Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
