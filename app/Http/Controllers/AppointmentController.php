<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Categories;
use App\Eligible;
use App\Mail\CandidateReturnMail;
use App\Schedule;
use App\SetEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
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
        $schedules = Schedule::all();
        $eligibles = Eligible::with('category.schedules')->where('user_id',Auth::user()->id)->get();

//        return $eligibles;
        return view('pages.appointment.book-slot',
            compact('schedules','eligibles'));
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


        $category_mail = Schedule::with('set_email')->find($request->input('schedule_id'));
        $candidate = User::find($request->input('candidate_id'));

        $eligible = Eligible::where('user_id',$candidate->id)->where('category_id', $category_mail->categories_id)->first();
        $eligible->booked = 1;
        $eligible->save();

        Appointment::updateOrCreate(
            ['user_id' => $candidate->id, 'category_id' => $category_mail->categories_id],
            [
                'user_id' => $candidate->id,
                'category_id' => $category_mail->categories_id,
                'schedule_id' => $category_mail->id,
            ]
        );

        $content=  str_replace('~venue',$category_mail->venue,
            str_replace('~id_card',$request->input('selected_id').", ID Number ".$request->input('card_number'),
                str_replace('~section',$category_mail->name,
                    str_replace('~first_name',substr($candidate->name,0,strpos($candidate->name,' ')),
                        str_replace('~start_time',substr($category_mail->start_date_time,10),
                            str_replace('~start_date',Carbon::parse($category_mail->start_date_time)->format('D dS M Y'),$category_mail->set_email->body))))));


        $data = array(
            'from' =>$category_mail->set_email->sender,
            'content'=>$content,
            'subscription' => $category_mail->set_email->subscription,
        );
        Mail::to($candidate->email)
            ->later(now()->addSeconds(5),new CandidateReturnMail($data));

        return "sent";
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
                $eligibles = Eligible::with('category.schedules')->where('user_id',$candidate_email->id)->get();
                return view('pages.appointment.book-slot',
                    compact('candidate_email','schedules','eligibles'));
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
        $eligibles = Eligible::with('category.schedules')->where('user_id',$candidate_email->id)->get();


        return view('pages.appointment.book-slot',
            compact('candidate_email','selected_schedule','schedules','eligibles'));
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
