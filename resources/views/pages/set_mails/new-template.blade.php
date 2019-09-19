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
                                <a href="{{route('set-emails.index')}}" class="btn d-flex align-items-center">
                                    <i class="mdi mdi-arrow-left-circle-outline mr-1"></i>
                                    <span class="font-weight-medium text-left">
                                    All Templates
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <div class="col-md-8 offset-md-2">
                       <div class="card">
                           <div class="card-body">
                               <form method="POST" class="needs-validation" novalidate action="{{route('set-emails.store')}}">
                                   @csrf

                                   <div class="form-group row">
                                       <div class="col-md-6">
                                           <input id="name" type="text" placeholder="Template Name" class="form-control" name="template_name" required >

                                           <div class="invalid-feedback" >
                                               Template Name required
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <input id="sender" type="email" placeholder="Sender Address" class="form-control" name="sender" required>
                                           <div class="invalid-feedback" >
                                               Sender address required
                                           </div>
                                       </div>
                                   </div>

                                   <div class="form-group row">
                                       <div class="col-md-6">
                                           <input id="subject" type="text" placeholder="Subject" class="form-control" name="subject" required>
                                           <div class="invalid-feedback" >
                                               Subject required
                                           </div>
                                       </div>

                                       {{--<div class="col-md-6">
                                           <input required id="salutation" placeholder="Salutation" type="text" class="form-control" name="salutation">
                                           <div class="invalid-feedback" >
                                               Salutation required
                                           </div>
                                       </div>--}}
                                   </div>
                                   <div class="form-group row">
                                       <div class="col-md-4 offset-md-8">
                                           <label for="merge_field">Add Field</label>
                                           <select name="merge_field" id="merge_field"  class="js-example-basic-single form-control form-control-sm font-weight-medium w-100">
                                               <option value=""></option>
                                               <option value="~first_name">First Name</option>
                                               <option value="~section">Selected Section</option>
                                               <option value="~venue">Schedule Venue</option>
                                               <option value="~start_date">Start Date</option>
                                               <option value="~start_time">Start Time</option>
                                               <option value="~id_card">ID Card & Number</option>
                                           </select>
                                           <div class="invalid-feedback" >
                                               Return Email required
                                           </div>
                                       </div>
                                   </div>
                                   <div class="form-group row">
                                       <div class="col-md-12">
                                           <label for="summernoteExample">Email Body</label>
                                           <textarea class="form-control mess-body" required id="summernoteExample" name="email-body"></textarea>
                                           <div class="invalid-feedback" >
                                               Email Body required
                                           </div>
                                       </div>
                                   </div>
                                   <div class="form-group row">
                                       <div class="col-md-12">
                                           <label for="subscription">Subscription</label>
                                           <textarea class="form-control" id="subscription" name="subscription"></textarea>
                                           <div class="invalid-feedback" >
                                               Subscription required
                                           </div>
                                       </div>
                                   </div>
                                   <div class="form-group row">
                                       <div class="col-md-12 text-right">
                                       <button type="submit" class="btn btn-success">Add Template</button>
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
