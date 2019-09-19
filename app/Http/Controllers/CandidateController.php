<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Eligible;
use App\User;
use App\Exports\UserExport;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CandidateController extends Controller
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
        $categories = Categories::all();
        return view('pages.candidates.index',compact('categories'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'unique:users'],
        ]);

        if ($validator->fails()){
            toastr()->error('Email is already exist');
            return back();
        }

        $candidate = new User();
        $candidate->name = $request->input('name');
        $candidate->email = $request->input('email');
        $candidate->phone_number = $request->input('phone_number');
        $candidate->password = Hash::make(strrev($request->input('email')));
        $candidate->role = 'Candidate';



        if ($candidate->save()){
            $eligible =new Eligible();
            $eligible->category_id = $request->input('category_id');
            $eligible->user_id = $candidate->id;
            $eligible->save();
            toastr()->success('New Candidate Added');
        }else{
            toastr()->error('Error while save');
        }


        return back();
    }

    public function delete_candidate(Request $request){
        $selected_id = $request->input('selected_id');
        foreach ($selected_id as $value){
            $level = User::find($value);
            $level->delete();

            $eligible = Eligible::where('user_id',$value)->first();
            $eligible->delete();
        }

        toastr()->success('Deleted Successfully');
        return back();
    }

    public function search_candidate(Request $request){
        $candidate_results = User::where('email', 'like', '%' . $request->input("search") . '%')->get();

//        return $candidate_results;
        return view('pages.candidates.search-results',
            compact('candidate_results'));

    }

    public function downloadUploadFormat(){

        $pathToFile = public_path('Upload_Format.xlsx');
        return response()->download($pathToFile, 'Upload_Format.xlsx');
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

    public function import(Request $request)
    {
        $candidates=   Excel::toCollection(new UserImport(), request()->file('file'));

        foreach ($candidates[0] as $candidate){
            if (substr($candidate['phone_number'],'0','1') !=0)
            {
                $phone_number = "0".$candidate['phone_number'];
            }else{
                $phone_number = $candidate['phone_number'];
            }

           $user= User::updateOrCreate(['email' => $candidate['email'],'role'=>'Candidate'],
                [
                    'name' => $candidate['name'],
                    'email' => $candidate['email'],
                    'phone_number' => $phone_number,
                    'role' => 'Candidate',
                    'password' => Hash::make(strrev($candidate['email']))
                ]);
            Eligible::updateOrCreate(
                ['user_id' => $user->id, 'category_id' => $request->input('category_id')]
            );

        }
        toastr()->success(count($candidates[0]).' Candidate Uploaded Successfully');
        return back();
    }

    public function all_candidate(){
        $categories = Categories::all();
        $candidates = User::with('eligible.category')->where('role','Candidate')->get();

        return view('pages.candidates.index',compact('candidates','categories'));
    }

    public function export()
    {
        return Excel::download(new UserExport(), 'candidate.xlsx');
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
        $candidate = User::find($id);
        $candidate->name = $request->input('name');
        $candidate->email = $request->input('email');
        $candidate->phone_number = $request->input('phone_number');

        if ($candidate->save()){
            toastr()->success('Candidate Info Updated');
        }else{
            toastr()->error('Error while saving');
        }


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
