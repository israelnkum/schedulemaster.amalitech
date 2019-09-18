@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6 mb-4 offset-md-3 text-center mb-xl-0">
                        <img src="{{asset('public/amalitechLogo.png')}}" alt="logo">
                        <h4 class="display-5">SCHEDULE MASTER</h4>
                    </div>
                </div>
                <div class="page-header-tab mt-xl-4">
                    <div class="col-12 pl-0 pr-0">
                        <div class="row ">
                            <div class="col-12 col-sm-12 mb-xs-4  pt-2 pb-2 mb-xl-0">
                                <ul class="nav nav-tabs tab-transparent" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#" role="tab" aria-controls="overview" aria-selected="true">{{$candidate_email->name}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="users-tab" data-toggle="tab" href="#" role="tab" aria-controls="users" aria-selected="false">{{$candidate_email->email}}</a>
                                    </li>
                                    <li class="nav-item ml-auto">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <a class="nav-link" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" id="users-tab" data-toggle="tab"  href="{{ route('logout') }}" role="tab" aria-controls="users" aria-selected="false">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content tab-transparent-content pb-0">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('select-schedule')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="candidate_id" value="{{$candidate_email->id}}">
                                        <div class="form-group row">
                                            <div class="col-md-8 offset-md-2">
                                                <h4 class="text-danger text-center font-weight-normal display-5">Please Select a Schedule</h4>
                                                <select required name="schedule" id="schedule"  class="form-control" data-placeholder="Select">
                                                    <option value="">~Select~</option>
                                                    @foreach($schedules as $schedule)
                                                        <option value="{{$schedule->id}}">{{$schedule->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @if(!empty($selected_schedule))
                            <div class="col-md-12 text-right">
                                <a data-toggle="collapse" href="#book-now" aria-controls="book-now"  class="btn btn-danger">Book Now</a>
                            </div>
                            <div class="accordion accordion-bordered" id="book-accordion" role="tablist">
                                <div class="card">
                                    <div id="book-now" class="collapse" role="tabpanel" aria-labelledby="heading-4" data-parent="#book-accordion">
                                        <div class="card-body">
                                            <form action="{{route('appointment.store')}}" method="post" class="needs-validation" novalidate>
                                                @csrf
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <input type="hidden" name="candidate_id" value="{{$candidate_email->id}}">
                                                        <label class="text-danger">Select a Valid ID Card</label>
                                                        <select required name="selected_id" id="selected_id"  class="form-control" data-placeholder="Select">
                                                            <option value="">~Select~</option>
                                                            <option value="Voters">Voters</option>
                                                            <option value="Ghana card">Ghana card</option>
                                                            <option value="NHIS">NHIS</option>
                                                            <option value="SSNIT">SSNIT</option>
                                                            <option value="Passport">Passport</option>
                                                            <option value="Old Driver's licence">Old Driver's Licence</option>
                                                            <option value="New Driver's licence">New Driver's licence</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            ID Card required
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="voters_id">Card Number</label>
                                                        <input style="display: none" required type="text" disabled class="form-control voters_id" id="voters_id"  name="voters_id" placeholder="Voters ID">
                                                        <input style="display: none" required type="text" disabled class="form-control ghana-card" id="ghana_card"  name="ghana_card" placeholder="Ghana Card">
                                                        <input style="display: none" required type="text" disabled class="form-control nhis" id="nhis"  name="nhis" placeholder="NHIS">
                                                        <input style="display: none" required type="text" disabled class="form-control ssnit" id="ssnit"  name="ssnit" placeholder="SSNIT">
                                                        <input style="display: none" required type="text" disabled class="form-control passport-id"  id="passport-id" name="passport_id" placeholder="Passport Number">
                                                        <input style="display: none" required type="text" disabled class="form-control old-drivers-license" minlength="8" id="old-drivers-license" maxlength="8"  name="old-drivers-license" placeholder="Certificate of Competence">
                                                        <input style="display: none" required type="text" disabled class="form-control new-drivers-license" id="new-drivers-license" name="new-drivers-license" placeholder="License Number">
                                                        <div class="invalid-feedback">
                                                            Card Number required
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-1">
                                                        <button type="submit" disabled class="btn btn-primary mt-4 btn-confirm-booking">Confirm Booking</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="page-header-tab mt-xl-4">
                                    <div class="col-12 pl-0 pr-0">
                                        <div class="row ">
                                            <div class="col-12 col-sm-12 mb-xs-4  pt-2 pb-2 mb-xl-0">
                                                <ul class="nav nav-tabs tab-transparent" role="tablist">
                                                    <li class="nav-item mr-auto">
                                                        <a class="nav-link text-primary"  href="javascript:void(0)" role="tab" >Selected Schedule <h4 class="font-weight-medium text-danger">{{$selected_schedule->name}}</h4></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link text-primary"  href="javascript:void(0)" role="tab" >Available Slots <h4 class="font-weight-medium">{{$selected_schedule->available_slot- $selected_schedule->used_slot}}</h4></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link text-primary"  href="javascript:void(0)" role="tab" >Start Date and Time <h4 class="font-weight-medium">{{\Carbon\Carbon::parse($selected_schedule->start_date_time)->format('D dS M Y H:i A')}}</h4></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link text-primary"  href="javascript:void(0)" role="tab" >End Date and Time <h4 class="font-weight-medium">{{\Carbon\Carbon::parse($selected_schedule->end_date_time)->format('D dS M Y H:i A')}}</h4></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <h4 class="mb-3">Description</h4>
                                {{$selected_schedule->description}} Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, hic, quam. A ex hic optio sequi sint. Alias architecto eum nesciunt, tempora tempore temporibus voluptas. Aut laboriosam natus necessitatibus nesciunt.
                            </div>
                            <div class="col-md-6 mt-2">
                                <h4 class="mb-3">Venue</h4>
                                {{$selected_schedule->venue}}
                            </div>
                        @endif
                    </div>
                </div>
                {{--<div class="tab-content tab-transparent-content pb-0">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <h4 class="card-title">Orders</h4>
                                        <div class="dropdown dropleft card-menu-dropdown">
                                            <button class="btn p-0" type="button" id="dropdown12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical card-menu-btn"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown12" x-placement="left-start">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="" enctype="multipart/form-data" id="wizard_with_validation" method="POST">
                                        @csrf
                                        <h3>Step 1</h3>
                                        <fieldset>
                                            <div class="form-group row">

                                            </div>
                                        </fieldset>
                                        <h3>Step 2</h3>
                                        <fieldset>
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <select required name="title"  class="form-control show-tick ms search-select" data-placeholder="Select">
                                                        <option value=""> Select title </option>
                                                        <option value="Mr">Mr.</option>
                                                        <option value="Mrs">Mrs.</option>
                                                        <option value="Miss">Miss.</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <select required name="mode_of_study"  class="form-control show-tick ms search-select" data-placeholder="Select">
                                                        <option value=""> Mode of Study </option>
                                                        <option value="Regular">Regular</option>
                                                        <option value="Evening">Evening</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group form-float">
                                                        <input type="hidden"  class="form-control" value="" disabled name="index_number" placeholder="Index Number">
                                                        <input required type="text"  class="form-control phone_number"  id="phone_number" minlength="10"   name="phone_number" placeholder="Phone Number">
                                                        <span class="err"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
@endsection
