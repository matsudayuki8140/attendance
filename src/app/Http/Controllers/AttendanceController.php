<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use App\Models\Worktime;
use App\Models\Breaktime;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function status($user)
    {
        $worktime = Worktime::with('user')
        ->where('user_id', $user['id'])
        ->latest('start')
        ->first();
        if(empty($worktime) || !empty($worktime['end'])) {
            $status = "private";
        } else {
            $breaktime = Breaktime::with('worktime')
            ->where('worktime_id', $worktime['id'])
            ->latest('start')
            ->first();
            if(empty($breaktime) || !empty($breaktime['end'])) {
                $status = "work";
            } else {
                $status = "break";
            }
        }
        return $status;
    }

    public function index()
    {
        $user = Auth::user()->only(['id', 'name']);
        $status = $this->status($user);
        return view('index', compact('user', 'status'));
    }

    public function workStart()
    {
        $user = Auth::user()->only(['id', 'name']);
        $date = Carbon::now();
        $worktime = [
            'user_id' => $user['id'],
            'date' => $date->toDateString(),
            'start' => $date->toDateTimeString(),
            'end' => NULL,
        ];
        Worktime::create($worktime);
        return redirect()->action([AttendanceController::class, 'index']);
    }

    public function workEnd()
    {
        $user = Auth::user()->only(['id', 'name']);
        $date = Carbon::now();
        $worktime = Worktime::with('user')
        ->where('user_id', $user['id'])
        ->latest('start')
        ->first();
        if($date->toDateString() === $worktime['date']) {
            $end = ['end' => $date->toDateTimeString()];
            Worktime::find($worktime['id'])->update($end);
        } else {
            $today = Carbon::today()->toDateTimeString();
            $end = ['end' => $today];
            Worktime::find($worktime['id'])->update($end);
            $worktime = [
                'user_id' => $user['id'],
                'date' => $date->toDateString(),
                'start' => $today,
                'end' => $date->toDateTimeString(),
            ];
            Worktime::create($worktime);
        }
        return redirect()->action([AttendanceController::class, 'index']);
    }

    public function breakStart()
    {
        $user = Auth::user()->only(['id', 'name']);
        $date = Carbon::now();
        $worktime = Worktime::with('user')
        ->where('user_id', $user['id'])
        ->latest('start')
        ->first();
        $breaktime = [
            'worktime_id' => $worktime['id'],
            'start' => $date->toDateTimeString(),
            'end' => NULL,
        ];
        Breaktime::create($breaktime);
        return redirect()->action([AttendanceController::class, 'index']);
    }

    public function breakEnd()
    {
        $user = Auth::user()->only(['id', 'name']);
        $date = Carbon::now();
        $worktime = Worktime::with('user')
        ->where('user_id', $user['id'])
        ->latest('start')
        ->first();
        $breaktime = Breaktime::with('worktime')
        ->where('worktime_id', $worktime['id'])
        ->latest('start')
        ->first();
        if($date->toDateString() === $worktime['date']) {
            $end = ['end' => $date->toDateTimeString()];
            Breaktime::find($breaktime['id'])->update($end);
            Worktime::find($worktime['id'])->update($end);
        } else {
            $today = Carbon::today()->toDateTimeString();
            $end = ['end' => $today];
            Breaktime::find($breaktime['id'])->update($end);
            Worktime::find($worktime['id'])->update($end);
            $worktime = [
                'user_id' => $user['id'],
                'date' => $date->toDateString(),
                'start' => $today,
                'end' => NULL,
            ];
            $worktime = Worktime::create($worktime);
            $breaktime = [
                'worktime_id' => $worktime['id'],
                'start' => $today,
                'end' => $date->toDateTimeString(),
            ];
            Breaktime::create($breaktime);
        }
        return redirect()->action([AttendanceController::class, 'index']);
    }
}
