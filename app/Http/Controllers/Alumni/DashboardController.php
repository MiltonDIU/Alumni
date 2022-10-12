<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
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



    public function index(){
        return view('alumni.dashboard');
    }
    public function batchMate(){
        return view('alumni.batch-mate');
    }
    public function batchMateProfile(){
        return view('alumni.batch-mate-profile');
    }
    public function schools(){
        return view('alumni.schools');
    }

    public function schoolProfile(){
        return view('alumni.schoolProfile');
    }
    public function events(){
        return view('alumni.events');
    }

}
