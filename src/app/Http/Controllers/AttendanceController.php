<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worktime;
use App\Models\Breaktime;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function attendance()
    {
        return view('date');
    }
}
