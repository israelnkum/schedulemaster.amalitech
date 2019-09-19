@extends('layouts.dash')

@section('dash-content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6 mb-4 mb-xl-0">
                        <h3>Categories</h3>
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
                                    <button class="btn d-flex align-items-center pr-0" data-toggle="modal" data-target="#new-user-modal">
                                        <i class="mdi mdi-note  mr-1"></i>
                                        <span class="text-left font-weight-medium">
                                        New Category
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
                                        <div class="table-responsive">
                                            <table id="category_table" class="table">
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
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th># of Sections</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                 @php($i = 1)
                                                 @foreach($categories as $category)
                                                     <tr>
                                                         <td class="pl-0">
                                                             <div class="form-check">
                                                                 <label class="form-check-label">
                                                                     <input type="checkbox" value="{{$category->id}}" class="form-check-input checkItem" name="selected_id[]">
                                                                     <i class="input-helper"></i></label>
                                                             </div>
                                                         </td>
                                                         <td>
                                                             {{$i}}
                                                         </td>
                                                         <td>{{$category->id}}</td>
                                                         <td class="text-muted font-weight-medium">
                                                             {{$category->name}}
                                                         </td>
                                                         <td class="text-muted font-weight-medium">
                                                             {{$category->sections}}
                                                         </td>
                                                         <td>
                                                             <button type="button" data-toggle="modal" data-target="#new-section-modal" class="btn new-category">
                                                                 <i class="mdi mdi-plus-circle"></i>
                                                             </button>
                                                         </td>
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



    <!--new Schedule modal Starts -->
    <div class="modal fade" id="new-section-modal" tabindex="-1" role="dialog" aria-labelledby="new-user-modal" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">New Section</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" class="needs-validation" novalidate action="{{route('schedules.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Name</label>
                                <input id="name" type="text" class="form-control" name="name" required >
                                <div class="invalid-feedback" >
                                    Name required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="set_emails_id">Return Email to Candidate</label><br>
                                <select name="set_emails_id" id="set_emails_id" required class="js-example-basic-single form-control">
                                    <option value=""></option>
                                    @foreach($emails as $email)
                                        <option value="{{$email->id}}">{{$email->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Return Email required
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
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

                            <div class="col-md-6">
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
                            <div class="col-md-4">
                                <input type="text" class="form-control" hidden name="category_id" id="category_id">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="venue">Venue</label>
                                <textarea required class="form-control" name="venue" id="venue" rows="8"></textarea>
                                <div class="invalid-feedback" >
                                    Venue required
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description"  rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--new Schedule Modal Ends -->

    <!--new user Modal Starts -->
    <div class="modal fade" id="new-user-modal" tabindex="-1" role="dialog" aria-labelledby="new-user-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" novalidate method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input required id="name" type="text" placeholder="Category Name" class="form-control" name="name">
                                <div class="invalid-feedback" role="alert">
                                    Category Name required
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--new user Modal Ends -->

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