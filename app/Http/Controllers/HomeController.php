<?php

namespace App\Http\Controllers;

use App\classes;
use App\student;
use App\Teacher;
use App\attendance;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->status == 1){
            $teacher = Teacher::where('email', auth()->user()->email)->first();
            $students = student::where('class_id', classes::where('class', $teacher->class)->first()->id)->count();
        }else{
            $students = student::all()->count();
            $teacher = count(Teacher::all());
        }
        if($students == null){
            $percante = '0';
            return view('home',compact('students','percante', 'teacher'));
        }else{
            if(auth()->user()->status == 0){
            $present = attendance::where('date',date('m/d/Y'))->where('attendance','P')->get()->count();
            $percante = floor((($present/$students)*100));
            }else{
                $present = attendance::where('date',date('m/d/Y'))->where('attendance','P')->where('class_id', classes::where('class', $teacher->class)->first()->id)->get()->count();
                $percante = floor((($present/$students)*100)); 
            }
            return view('home',compact('students','percante', 'teacher'));
        }
        
        
    }
   
}
