@extends('layouts.dash')

@section('dash-content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6 mb-4 mb-xl-0">
                        <h3>Search Results</h3>
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
                                            Send Email
                                            </span>
                                    </button>


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
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <div class="accordion accordion-bordered" id="accordion-2" role="tablist">
                                    @php($i =1)
                                    @foreach($candidate_results as $candidate)
                                        <div class="accordion accordion-bordered" id="accordion-2" role="tablist">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="heading-4">
                                                    <h6 class="mb-0">
                                                        <a data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                                            {{$candidate->email}}
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="collapse-4" class="collapse" role="tabpanel" aria-labelledby="heading-4" data-parent="#accordion-2">
                                                    <div class="card-body">
                                                        <p class="mb-0">You can pay for the product you have purchased using credit cards, debit cards, or via online banking. We also provide cash-on-delivery services for most of our products. You can also use your account wallet for payment. </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php($i++)
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="new-candidate-modal" tabindex="-1" role="dialog" aria-labelledby="new-candidate-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">New Candidate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" class="needs-validation" novalidate action="{{route('candidates.store')}}">
                    @csrf
                    <div class="modal-body">
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
                                <input id="phone_number" placeholder="Phone Number" type="text" class="form-control" name="phone_number">
                                <div class="invalid-feedback" >
                                    Phone Number required
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

@endsection
