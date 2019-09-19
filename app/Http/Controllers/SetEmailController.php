<?php

namespace App\Http\Controllers;

use App\Mail\CandidateReturnMail;
use App\SetEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SetEmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = SetEmail::all();

        return view('pages.set_mails.index',compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.set_mails.new-template');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mail = new SetEmail();
        $mail->name = $request->input('template_name');
        $mail->sender = $request->input('sender');
        $mail->subject = $request->input('subject');
        $mail->salutation = '';
        $mail->body = $request->input('email-body');
        $mail->subscription = $request->input('subscription');

        if ($mail->save()){
            toastr()->success('New Template Created');
            return back();
        }
    }

    public function delete_emails(Request $request){
        $selected_id = $request->input('selected_email_id');
        foreach ($selected_id as $value){
            $level = SetEmail::find($value);
            $level->delete();
        }

        toastr()->success('Deleted Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $email = SetEmail::find($id);


        return view('pages.set_mails.edit-template',compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mail = SetEmail::find($id);
        $mail->name = $request->input('template_name');
        $mail->sender = $request->input('sender');
        $mail->subject = $request->input('subject');
        $mail->salutation = $request->input('salutation');
        $mail->body = $request->input('email-body');
        $mail->subscription = $request->input('subscription');

        if ($mail->save()){
            toastr()->success('Template Updated');
            return back();
        }
    }


    public function send_candidate_email(Request $request){
        $data = array(
            'title' =>'Osikani Israel',
        );
        Mail::to(['israelnkum@gmail.com','amos.nkum@amalitech.com'])
            ->later(now()->addSeconds(5),new CandidateReturnMail($data));
        toastr()->success('Email Sent Successfully');
        return back();

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
