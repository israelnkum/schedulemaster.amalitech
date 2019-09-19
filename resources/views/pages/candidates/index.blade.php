@extends('layouts.dash')

@section('dash-content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6 mb-4 mb-xl-0">
                        <h3>Candidates</h3>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center justify-content-md-end">
                            <div class="pr-4 pl-4 mb-3 mb-xl-0 d-xl-block d-none">
                                <h6 class="font-weight-medium text-muted mb-0">Filter</h6>
                            </div>

                            <div class="mb-3 mb-xl-0">
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-success">14 Aug 2019</button>
                                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
                                        <a class="dropdown-item" href="#">2015</a>
                                        <a class="dropdown-item" href="#">2016</a>
                                        <a class="dropdown-item" href="#">2017</a>
                                        <a class="dropdown-item" href="#">2018</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header-tab mt-xl-4">
                    <div class="col-12 pl-0 pr-0">
                        <div class="row ">
                            <div class="col-12 col-sm-4 mb-xs-4  pt-2 pb-2 mb-xl-0">
                                <a href="{{route('all-candidate')}}" class="btn d-flex align-items-center">
                                    <i class="mdi mdi-file-document  mr-1"></i>
                                    <span class="font-weight-medium text-left">
                                    All Candidate
                                    </span>
                                </a>
                            </div>
                            <div class="col-12 col-sm-8 mb-xs-4 mb-xl-0 pt-2 pb-2 text-md-right d-none d-md-block">
                                @if(Route::is('all-candidate'))
                                    <div class="d-inline-flex">
                                        <button data-toggle="modal" data-target="#deleteStaff" id="deleteSelected" disabled class="btn text-danger d-flex align-items-center">
                                            <i class="mdi mdi-trash-can mr-1"></i>
                                            <span class="text-left font-weight-medium">
                                            Delete
                                            </span>
                                        </button>
                                        <a href="{{route('candidate-export')}}" class="btn d-flex align-items-center">
                                            <i class="mdi mdi-file-pdf  mr-1"></i>
                                            <span class="font-weight-medium text-left">
                                            Export
                                            </span>
                                        </a>
                                        {{--<button data-toggle="modal" data-target="#send-candidate-mail" disabled id="btn_send_candidate_mail" class="btn d-flex align-items-center pr-0">
                                            <i class="mdi mdi-email-outline  mr-1"></i>
                                            <span class="text-left font-weight-medium">
                                            Send Email
                                            </span>
                                            --}}{{--                                            href="{{route('send-candidate-mail')}}"--}}{{--
                                        </button>--}}
                                        <a href="{{route('send-candidate-mail')}}" class="btn d-flex align-items-center pr-0">
                                            <i class="mdi mdi-email-outline  mr-1"></i>
                                            <span class="text-left font-weight-medium">
                                            Send Email
                                            </span>
                                        </a>
                                        @endif

                                        <button class="btn d-flex align-items-center pr-0" data-toggle="modal" data-target="#new-candidate-modal">
                                            <i class="mdi mdi-account  mr-1"></i>
                                            <span class="text-left font-weight-medium">
                                        New/Upload Candidate
                                        </span>
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if(Route::is('all-candidate'))
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('delete-candidate')}}" id="delete_candidate_form" method="POST">
                                        @csrf
                                        <div class="table-responsive">
                                            <table id="candidate_table" class="table my-table">
                                                <thead>
                                                <tr>
                                                    <th class="pl-0">
                                                        <div class="form-check mb-0">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" id="checkAllCandidate" class="form-check-input">
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                    </th>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <td>Id</td>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 1)
                                                @foreach($candidates as $candidate)
                                                    <tr>
                                                        <td class="pl-0">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" value="{{$candidate->id}}" class="form-check-input checkCandidateItem" name="selected_id[]">
                                                                    <i class="input-helper"></i></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{$i}}
                                                        </td>
                                                        <td class="text-muted font-weight-medium">
                                                            {{$candidate->name}}
                                                        </td>
                                                        <td  class="text-muted font-weight-medium">
                                                            {{$candidate->email}}
                                                        </td>
                                                        <td class="text-muted font-weight-medium">
                                                            {{$candidate->phone_number}}
                                                        </td>
                                                        <td>{{$candidate->id}}</td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="text-dark edit"><i class="mdi mdi-account-edit"></i> Edit</a>
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
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="new-candidate-modal" tabindex="-1" role="dialog" aria-labelledby="new-candidate-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">New/Upload Candidate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="accordion accordion-bordered" id="accordion-2" role="tablist">
                        <div class="accordion accordion-bordered" id="accordion-2" role="tablist">
                            <div class="card">
                                <div class="card-header" role="tab" id="heading-4">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                            New Candidate
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapse-4" class="collapse" role="tabpanel" aria-labelledby="heading-4" data-parent="#accordion-2">
                                    <form method="POST" class="needs-validation" novalidate action="{{route('candidates.store')}}">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="name" type="text" placeholder="Full Name" class="form-control" name="name" required >

                                                <div class="invalid-feedback" >
                                                    Full Name required
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input id="email" type="email" placeholder="Email Address" class="form-control" name="email" required>
                                                <div class="invalid-feedback" >
                                                    Email required
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <input id="phone_number" placeholder="Phone Number" type="text" class="form-control phone_number" name="phone_number">
                                                <div class="invalid-feedback" >
                                                    Phone Number required
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="categories">Category</label><br>
                                                <select name="category_id" id="categories" style="width: 100%" required class="js-example-basic-single form-control font-weight-medium w-100">
                                                    <option value=""></option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback" >
                                                    Category required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="heading-4">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#upload-candidate" aria-expanded="false" aria-controls="collapse-4">
                                            Upload Candidate(s)
                                        </a>
                                    </h6>
                                </div>
                                <div id="upload-candidate" class="collapse" role="tabpanel" aria-labelledby="heading-4" data-parent="#accordion-2">
                                    <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate action="{{route('upload-candidates')}}">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="file" type="file" placeholder="Full Name" class="form-control" name="file" required >

                                                <div class="invalid-feedback" >
                                                    Full Name required
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="categories">Category</label><br>
                                                <select name="category_id" id="categories" style="width: 100%" required class="js-example-basic-single form-control font-weight-medium w-100">
                                                    <option value=""></option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback" >
                                                    Category required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Ends -->

    <div class="modal fade" id="deleteStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Candidate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <p>Are you want to delete selected Candidate(s)</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="icon icon-close"></i> Close
                    </button>
                    <button type="submit" id="btn_delete_candidate" class="btn btn-success">
                        <i class="icon icon-trash"></i> Yes! Delete
                    </button>
                </div>
            </div>
        </div>
    </div>


    {{--Send email Modal--}}
    <div class="modal fade" id="send-candidate-mail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Mail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <p>Are you want to delete selected Candidate(s)</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="icon icon-close"></i> Close
                    </button>
                    <button type="submit" id="btn_delete_candidate" class="btn btn-success">
                        <i class="icon icon-trash"></i> Yes! Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{--End Send email Modal--}}
    <div class="modal fade" id="edit-candidate-info" tabindex="-1" role="dialog" aria-labelledby="edit-candidate-info" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="candidate-tittle">Edit Candidate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="edit-candidate-form" class="needs-validation" novalidate action="/candidates">
                    @csrf
                    {{method_field('put')}}
                    <div class="modal-body pt-0">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="edit-name" type="text" placeholder="Full Name" class="form-control" name="name" required >

                                <div class="invalid-feedback" >
                                    Full Name required
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="edit-email" type="email" placeholder="Email Address" class="form-control" name="email" required>
                                <div class="invalid-feedback" >
                                    Email required
                                </div>
                            </div>

                            <div class="col-md-6">
                                <input id="edit-phone_number" placeholder="Phone Number" type="text" class="form-control" name="phone_number">
                                <div class="invalid-feedback" >
                                    Phone Number required
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="categories">Category</label><br>
                                <select name="category_id" id="categories" style="width: 100%" required class="js-example-basic-single form-control font-weight-medium w-100">
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" >
                                    Category required
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="icon icon-close"></i> Close
                        </button>
                        <button type="submit" id="btn_delete_candidate" class="btn btn-success">
                             Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
