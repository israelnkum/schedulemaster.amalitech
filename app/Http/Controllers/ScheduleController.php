<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Schedule;
use App\SetEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ScheduleController extends Controller
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
        $schedules = Schedule::with('set_email')->get();

        return view('pages.schedules.index',compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emails = SetEmail::all();
        return view('pages.schedules.new-schedule',compact('emails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schedule = new Schedule();
        $schedule->set_email_id = $request->input('set_emails_id');
        $schedule->name = $request->input('name');
        $schedule->available_slot = $request->input('available_slot');
        $schedule->start_date_time = $request->input('start_date_time');
        $schedule->end_date_time = $request->input('end_date_time');
        $schedule->venue = $request->input('venue');
        $schedule->description = $request->input('description');
        if ($schedule->save()){
            toastr()->success('New Schedule Added');
        }else{
            toastr()->error('Error while saving, Please Try again');
        }


        return back();

       /* $data = array(
            'title' =>$request->input('title'),
            'position' =>$getPosition[0]->name,
            'first_name' =>$request->input('first_name'),
            'last_name' =>$request->input('last_name'),
            'other_name' =>$request->input('other_name'),
            'index_number' =>$indexnumber
        );

        Mail::to($request->input('email'))->send(new  SendMail($data));*/
    }


    public function delete_schedule(Request $request){

        $selected_id = $request->input('selected_schedule_id');

        foreach ($selected_id as $value){
            $level = Schedule::find($value);
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
        $schedule = Schedule::with('set_email')->find($id);

//        return $schedule;
        $emails = SetEmail::all();
        return view('pages.schedules.edit-schedule',compact('emails','schedule'));
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
        $schedule = Schedule::find($id);
        $schedule->set_email_id = $request->input('set_emails_id');
        $schedule->name = $request->input('name');
        $schedule->available_slot = $request->input('available_slot');
        $schedule->start_date_time = $request->input('start_date_time');
        $schedule->end_date_time = $request->input('end_date_time');
        $schedule->venue = $request->input('venue');
        $schedule->description = $request->input('description');
        if ($schedule->save()){
            toastr()->success('Schedule Updated');
        }else{
            toastr()->error('Error while saving, Please Try again');
        }


        return redirect()->route('schedules.index');
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
