@extends('layouts.dash')

@section('dash-content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6 mb-4 mb-xl-0">
                        <h3>New Email Template</h3>
                    </div>
                </div>
                <div class="page-header-tab mt-xl-4">
                    <div class="col-12 pl-0 pr-0">
                        <div class="row ">
                            <div class="col-12 col-sm-4 mb-xs-4  pt-2 pb-2 mb-xl-0">
                                <a href="{{route('schedules.index')}}" class="btn d-flex align-items-center">
                                    <i class="mdi mdi-arrow-left-circle-outline mr-1"></i>
                                    <span class="font-weight-medium text-left">
                                    All Schedules
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 mb-5" >
                    <div class="col-md-8 offset-md-2" style="margin-bottom: 150px;">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" class="needs-validation" novalidate action="{{route('schedules.store')}}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="">Name</label>
                                            <input id="name" type="text" class="form-control" name="name" required >

                                            <div class="invalid-feedback" >
                                                Name required
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Return Email to Candidates</label>
                                            <select name="set_emails_id" required class="js-example-basic-single form-control font-weight-medium w-100">
                                                <option value=""></option>
                                                @foreach($emails as $email)
                                                    <option value="{{$email->id}}">{{$email->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback" >
                                                Return Email required
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="">Start Date and Time</label>
                                            <div class="input-group date"  id="datetimepicker6" data-target-input="nearest">
                                                <div class="input-group" data-target="#datetimepicker6" data-toggle="datetimepicker">
                                                    <input type="text" name="start_date_time" required class="form-control datetimepicker-input" data-target="#datetimepicker6"/>
                                                    <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
                                                    <div class="invalid-feedback" >
                                                        Start Date and Time required
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <label for="">End Date and Time</label>
                                            <div class="input-group date"  id="datetimepicker7" data-target-input="nearest">
                                                <div class="input-group" data-target="#datetimepicker7" data-toggle="datetimepicker">
                                                    <input required type="text" name="end_date_time" class="form-control datetimepicker-input" data-target="#datetimepicker7"/>
                                                    <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
                                                    <div class="invalid-feedback" >
                                                        End Date and Time required
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Available Slot</label>
                                            <input id="slots" min="1" type="number" class="form-control" name="available_slot" required>
                                            <div class="invalid-feedback" >
                                                Slot required
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="venue">Venue</label>
                                            <textarea required class="form-control" name="venue" id="venue" rows="8"></textarea>
                                            <div class="invalid-feedback" >
                                                Venue required
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="description">Description</label>
                                            <textarea name="description" class="form-control" id="description"  rows="8"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn btn-success">Add Schedule</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
