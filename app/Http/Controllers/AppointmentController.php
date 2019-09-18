<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AppointmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.appointment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
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

    public function confirm_email(Request $request){
//        return $request;
        $candidate_email = User::where('email',$request->input('email'))->where('role','Candidate')->first();

        if (empty($candidate_email)){
            return back()->with('error','Email not Found, Please check your email and try again');
        }else{
            $check = Hash::check(strrev($request->input('email')),$candidate_email->password);

            if ($check==true){
                $schedules = Schedule::all();
                return view('pages.appointment.book-slot',compact('candidate_email','schedules'));
            }
            else{
                return back()->with('error','Email not Found, Please check your email and try again');
            }
       }
    }

    public function select_schedule(Request $request){
        $candidate_email = User::where('id',$request->input('candidate_id'))->where('role','Candidate')->first();
        $schedules = Schedule::all();
        $selected_schedule = Schedule::where('id',$request->input('schedule'))->first();


        return view('pages.appointment.book-slot',compact('candidate_email','selected_schedule','schedules'));
//        return redirect()->route('confirm-email',['request'=>'israelnkum@gmail.com']);
    }


    public function  logout(){
//        session_destroy();
        session_abort();
        session_unset();

        return view('pages.appointment.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
