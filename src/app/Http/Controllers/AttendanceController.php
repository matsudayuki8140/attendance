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

    public function attendance(Request $request)
    {
        $date = Carbon::parse('2021-11-01');
        $attendances = $this->getWorkingData($date);
        $date = $date->toDateString();
        $attendances = collect($attendances);
        $attendances = new LengthAwarePaginator(
            $attendances->forPage($request->page,5),
            count($attendances),
            5,
            $request->page,
            array('path' => $request->url())
        );

        return view('date', compact('date', 'attendances'));
    }

    public function before(Request $request)
    {
        $date = $request->only('date');
        $date = Carbon::parse($date['date'])->subDay();
        $attendances = $this->getWorkingData($date);
        $date = $date->toDateString();
        $attendances = collect($attendances);
        $attendances = new LengthAwarePaginator(
            $attendances->forPage($request->page,5),
            count($attendances),
            5,
            $request->page,
            array('path' => $request->url())
        );

        return view('date', compact('date', 'attendances'));
    }

    public function after(Request $request)
    {
        $date = $request->only('date');
        $date = Carbon::parse($date['date'])->addDay();
        $attendances = $this->getWorkingData($date);
        $date = $date->toDateString();
        $attendances = collect($attendances);
        $attendances = new LengthAwarePaginator(
            $attendances->forPage($request->page,5),
            count($attendances),
            5,
            $request->page,
            array('path' => $request->url())
        );

        return view('date', compact('date', 'attendances'));
    }

    public function getWorkingData($date)
    {
        // 表示する勤務データを取得
		$worktimes = Worktime::with('user')->where('date', $date)->get();
        $attendances = array();
        $breakTotal = 0;
        foreach($worktimes as $worktime) {
            // 名前を取得
            $user = User::find($worktime['user_id']);

            if(empty($worktime['end'])) { // 勤務中だった時の表示
                // 休憩時間合計を計算
                $breaktimes = Breaktime::with('worktime')->where('worktime_id', $worktime['id'])->get();
                foreach($breaktimes as $breaktime) {
                    if(!empty($breaktime['end'])) {
                        // 休憩開始から休憩終了まで何時間か
                        $diffInSeconds = Carbon::parse($breaktime['start'])->diffInSeconds(Carbon::parse($breaktime['end']));
                        $breakTotal = $breakTotal + $diffInSeconds;
                    }
                }
	            $hours = floor($breakTotal / 3600);
	            $minutes = floor(($breakTotal % 3600) / 60);
	            $seconds = $breakTotal % 60;
	            $break = Carbon::parse($hours . ":" . $minutes . ":" . $seconds);

	            $breakTotal = 0;
	            array_push($attendances, [
                    'name' => $user['name'],
                    'start' => Carbon::parse($worktime['start'])->toTimeString(),
                    'end' => "勤務中",
                    'break' => $break->toTimeString(),
                    'total' => "勤務中",
                ]);
            } else {
                // 勤務開始から勤務終了まで何時間か
                $workTotal = Carbon::parse($worktime['start'])->diffInSeconds(Carbon::parse($worktime['end']));

                // 休憩時間合計を計算
                $breaktimes = Breaktime::with('worktime')->where('worktime_id', $worktime['id'])->get();
                foreach($breaktimes as $breaktime) {
                    // 休憩開始から休憩終了まで何時間か
                    $diffInSeconds = Carbon::parse($breaktime['start'])->diffInSeconds(Carbon::parse($breaktime['end']));
                    $breakTotal = $breakTotal + $diffInSeconds;
                }
                $hours = floor($breakTotal / 3600);
                $minutes = floor(($breakTotal % 3600) / 60);
                $seconds = $breakTotal % 60;
                $break = Carbon::parse($hours . ":" . $minutes . ":" . $seconds);

                // 勤務時間から合計休憩時間を引く
                $totalSeconds = $workTotal - $breakTotal;
                $hours = floor($totalSeconds / 3600);
                $minutes = floor(($totalSeconds % 3600) / 60);
                $seconds = $totalSeconds % 60;
                $total = Carbon::parse($hours . ":" . $minutes . ":" . $seconds);
                $breakTotal = 0;  // 次の人の計算に引き継がないため
                array_push($attendances, [
                    'name' => $user['name'],
                    'start' => Carbon::parse($worktime['start'])->toTimeString(),
                    'end' => Carbon::parse($worktime['end'])->toTimeString(),
                    'break' => $break->toTimeString(),
                    'total' => $total->toTimeString(),
                ]);
            }
        }
        return $attendances;
    }
}
