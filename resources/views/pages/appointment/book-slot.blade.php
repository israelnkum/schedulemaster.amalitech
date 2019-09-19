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
                @if($eligibles[0]->booked == 1)
                    lor
                    @else
                <div class="page-header-tab mt-xl-4">
                    <div class="col-12 pl-0 pr-0">
                        <div class="row ">
                            <div class="col-12 col-sm-12 mb-xs-4  pt-2 pb-2 mb-xl-0">
                                <ul class="nav nav-tabs tab-transparent" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#" role="tab" aria-controls="overview" aria-selected="true">{{Auth::user()->name}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="users-tab" data-toggle="tab" href="#" role="tab" aria-controls="users" aria-selected="false">{{Auth::user()->email}}</a>
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
                                    @foreach($eligibles as $categories)
                                        <form action="{{route('select-schedule')}}" method="post">
                                            @csrf

                                            <input type="hidden" name="candidate_id" value="{{Auth::user()->id}}">
                                            <div class="form-group row">
                                                <div class="col-md-8 offset-md-2">
                                                    <h4 class="text-danger text-center font-weight-normal display-5">Please Select a Section</h4>
                                                    <select required name="schedule" id="schedule"  class="form-control" data-placeholder="Select">
                                                        <option value="">~Select~</option>
                                                        @foreach($categories->category->schedules as $schedule)
                                                            <option value="{{$schedule->id}}">{{$schedule->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if(!empty($selected_schedule))
                            <a data-toggle="modal" href="javascript:void(0)" data-target="#book-now" id="btn-book-now" class="btn btn-danger">Book Now</a>

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

                            <div class="modal fade" id="book-now" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{route('appointment.store')}}" method="post" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Book Slot</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body pt-0">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <input type="hidden"  name="schedule_id" id="schedule_id" class="form-control" value="{{$selected_schedule->id}}">
                                                        <input type="hidden" name="category_id" value="{{$eligibles[0]->category->id}}">
                                                        <input type="hidden" name="candidate_id" value="{{Auth::user()->id}}">
                                                        <label class="text-danger mt-2">Select a Valid ID Card</label>
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
                                                    <div class="col-md-6 mt-2">
                                                        <label for="voters_id" id="my-label" class="text-danger">Card Number</label>
                                                        <input style="display: none" required type="text" disabled class="form-control voters_id" id="voters_id"  name="card_number" placeholder="Voters ID">
                                                        <input style="display: none" required type="text" disabled class="form-control ghana-card" id="ghana_card"  name="card_number" placeholder="Ghana Card">
                                                        <input style="display: none" required type="text" disabled class="form-control nhis" id="nhis"  name="card_number" placeholder="NHIS">
                                                        <input style="display: none" required type="text" disabled class="form-control ssnit" id="ssnit"  name="card_number" placeholder="SSNIT">
                                                        <input style="display: none" required type="text" disabled class="form-control passport-id"  id="passport-id" name="card_number" placeholder="Passport Number">
                                                        <input style="display: none" required type="text" disabled class="form-control old-drivers-license" minlength="8" id="old-drivers-license" maxlength="8"  name="card_number" placeholder="Certificate of Competence">
                                                        <input style="display: none" required type="text" disabled class="form-control new-drivers-license" id="new-drivers-license" name="card_number" placeholder="License Number">
                                                        <div class="invalid-feedback">
                                                            Card Number required
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    <i class="icon icon-close"></i> Close
                                                </button>
                                                <button type="submit" disabled class="btn btn-success btn-confirm-booking">
                                                    <i class="icon icon-trash"></i> Confirm Booking
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
                    @endif
            </div>
        </div>
    </div>


@endsection
