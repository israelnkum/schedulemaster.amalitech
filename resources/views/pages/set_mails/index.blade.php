@extends('layouts.dash')

@section('dash-content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6 mb-4 mb-xl-0">
                        <h3>Setup Email</h3>
                    </div>
                </div>
                <div class="page-header-tab mt-xl-4">
                    <div class="col-12 pl-0 pr-0">
                        <div class="row ">
                            <div class="col-12 col-sm-4 mb-xs-4  pt-2 pb-2 mb-xl-0">

                            </div>
                            <div class="col-12 col-sm-8 mb-xs-4 mb-xl-0 pt-2 pb-2 text-md-right d-none d-md-block">
                                <div class="d-inline-flex">
                                    <button data-toggle="modal" data-target="#deleteStaff" id="deleteSelectedEmail" disabled class="btn text-danger d-flex align-items-center">
                                        <i class="mdi mdi-trash-can mr-1"></i>
                                        <span class="text-left font-weight-medium">
                                            Delete
                                            </span>
                                    </button>
                                    <a href="{{route('set-emails.create')}}" class="btn d-flex align-items-center pr-0">
                                        <i class="mdi mdi-file-document  mr-1"></i>
                                        <span class="text-left font-weight-medium">
                                        New Template
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                @if(count($emails) == 0)
                                    <div class="text-center">
                                        <h6 class="display-5">You've not Created any email Yet</h6>
                                        <a href="{{route('set-emails.create')}}" class="btn btn-primary">
                                            <i class="mdi mdi-file-document "></i>
                                            Create New Template
                                        </a>

                                    </div>
                                @else
                                    <form action="{{route('delete-emails')}}" id="delete_email_form" method="POST">
                                        @csrf
                                        @php($i = 1)


                                        <div class="form-check mb-0">
                                            <label class="form-check-label">
                                                <input type="checkbox" id="checkAllEmails" class="form-check-input">
                                                <i class="input-helper"></i> Check all</label>
                                        </div>

                                        <div class="row">
                                            @php($i = 1)
                                            @foreach($emails as $email)

                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" value="{{$email->id}}" class="form-check-input checkEmailItem" name="selected_email_id[]">
                                                            <i class="input-helper"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-11">
                                                    <div class="accordion accordion-bordered" id="accordion-2" role="tablist">
                                                        <div class="card">
                                                            <div class="card-header" role="tab" id="heading-4">
                                                                <div class="row">
                                                                    <div class="col-md-11">
                                                                        <a data-toggle="collapse" href="#sh-{{$email->id}}" aria-expanded="false" aria-controls="sh-{{$email->id}}">
                                                                            {{$email->name}}
                                                                            {{--                                                                            {{\Carbon\Carbon::parse($email->start_end_date)->toFormattedDateString()}}--}}
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <a href="{{route('set-emails.edit',$email->id)}}" class="btn" title="Edit"> <i style="font-size: 20px;" class="mdi mdi-pencil-circle"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="sh-{{$email->id}}" class="collapse" role="tabpanel" aria-labelledby="heading-4" data-parent="#accordion-2">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12 mt-2">
                                                                            <h4 class="mb-3">Return Email</h4>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <blockquote class="blockquote">
                                                                                        <h6>Subject: <span class="font-weight-normal">{{$email->subject}}</span></h6>
                                                                                    </blockquote>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <blockquote class="blockquote">
                                                                                        <h6>From: <span class="font-weight-normal">{{$email->sender}}</span></h6>
                                                                                    </blockquote>
                                                                                </div>
                                                                            </div>
                                                                            <blockquote class="blockquote">
                                                                                <h6>Body: </h6>
                                                                                <p>{{$email->salutation}} [Candidate First Name], <br> {!! html_entity_decode($email->body) !!}
                                                                                    <br>
                                                                                    {!! html_entity_decode($email->subscription) !!}
                                                                                </p>
                                                                            </blockquote>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php($i++)
                                            @endforeach
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="new-candidate-modal" tabindex="-1" role="dialog" aria-labelledby="new-candidate-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">New/Upload Candidate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                                <input id="phone_number" placeholder="Phone Number" type="text" class="form-control" name="phone_number">
                                <div class="invalid-feedback" >
                                    Phone Number required
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="summernoteExample">
                                    <h4>The standard Lorem Ipsum passage, used since the 1500s</h4>
                                    <img src="http://www.urbanui.com/hiliteui/template/images/carousel/banner_1.jpg" class="ml-2 mb-2 w-25" alt="img">
                                    <p class="text-justify">
                                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                                    </p>
                                    <p class="text-justify">
                                        "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                        veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                                        magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
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
                    <p>Are you want to delete selected Email(s)</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="icon icon-close"></i> Close
                    </button>
                    <button type="submit" id="btn_delete_email" class="btn btn-success">
                        <i class="icon icon-trash"></i> Yes! Delete
                    </button>
                </div>
            </div>
        </div>
    </div>


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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="icon icon-close"></i> Close
                        </button>
                        <button type="submit" id="btn_delete_candidate" class="btn btn-success">
                            <i class="icon icon-trash"></i> Yes! Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
