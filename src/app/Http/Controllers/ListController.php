<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use App\Models\Worktime;
use App\Models\Breaktime;
use Carbon\Carbon;

class ListController extends Controller
{
    public function getWorkingData($date)
    {
        // 表示する勤務データを取得
		$worktimes = Worktime::with('user')->where('date', $date)->get();
        $attendances = array();
        foreach($worktimes as $worktime) {
            // 名前を取得
            $user = User::find($worktime['user_id']);
            $breakTotal = 0;  // 次の人の計算に引き継がないため

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
	            $break = Carbon::parse($hours . ":" . $minutes . ":" . $seconds)->toTimeString();

	            array_push($attendances, [
                    'name' => $user['name'],
                    'start' => Carbon::parse($worktime['start'])->toTimeString(),
                    'end' => "勤務中",
                    'break' => $break,
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
                $break = Carbon::parse($hours . ":" . $minutes . ":" . $seconds)->toTimeString();

                // 勤務時間から合計休憩時間を引く
                $totalSeconds = $workTotal - $breakTotal;
                $hours = floor($totalSeconds / 3600);
                $minutes = floor(($totalSeconds % 3600) / 60);
                $seconds = $totalSeconds % 60;
                $total = Carbon::createFromTime($hours, $minutes, $seconds)->toTimeString();
                array_push($attendances, [
                    'name' => $user['name'],
                    'start' => Carbon::parse($worktime['start'])->toTimeString(),
                    'end' => Carbon::parse($worktime['end'])->toTimeString(),
                    'break' => $break,
                    'total' => $total,
                ]);
            }
        }
        return $attendances;
    }

    public function attendance(Request $request)
    {
        $date = Carbon::now();
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
        $page = $request->page;
        if($page == null) {
            $date = Carbon::parse($date['date'])->subDay();
        } else {
            $date = Carbon::parse($date['date']);
        }
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
        $page = $request->page;
        if($page == null) {
            $date = Carbon::parse($date['date'])->addDay();
        } else {
            $date = Carbon::parse($date['date']);
        }
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

    public function users(Request $request)
    {
        $users = User::Paginate(5);
        return view('users', compact('users'));
    }

    public function getUserWorkingData($userId)
    {
        // 表示する勤務データを取得
		$worktimes = Worktime::with('user')->where('user_id', $userId)->get();
        $attendances = array();
        foreach($worktimes as $worktime) {
            $breakTotal = 0;  // 次の人の計算に引き継がないため

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
	            $break = Carbon::parse($hours . ":" . $minutes . ":" . $seconds)->toTimeString();

	            array_push($attendances, [
                    'date' => $worktime['date']->toDateString(),
                    'start' => Carbon::parse($worktime['start'])->toTimeString(),
                    'end' => "勤務中",
                    'break' => $break,
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
                $break = Carbon::parse($hours . ":" . $minutes . ":" . $seconds)->toTimeString();

                // 勤務時間から合計休憩時間を引く
                $totalSeconds = $workTotal - $breakTotal;
                $hours = floor($totalSeconds / 3600);
                $minutes = floor(($totalSeconds % 3600) / 60);
                $seconds = $totalSeconds % 60;
                $total = Carbon::createFromTime($hours, $minutes, $seconds)->toTimeString();
                array_push($attendances, [
                    'date' => $worktime['date'],
                    'start' => Carbon::parse($worktime['start'])->toTimeString(),
                    'end' => Carbon::parse($worktime['end'])->toTimeString(),
                    'break' => $break,
                    'total' => $total,
                ]);
            }
        }
        return $attendances;
    }

    public function userAttendance(Request $request)
    {
        $userId = $request->userId;
        $user = User::find($userId);
        $attendances = $this->getUserWorkingData($userId);
        $attendances = collect($attendances);
        $attendances = new LengthAwarePaginator(
            $attendances->forPage($request->page,5),
            count($attendances),
            5,
            $request->page,
            array('path' => $request->url())
        );

        return view('user-attendance', compact('user', 'attendances'));
    }

    public function userBefore(Request $request)
    {
        $userId = $request->userId;
        $page = $request->page;
        if($page == null) {
            $userId = $request->userId - 1;
        }
        $user = User::find($userId);
        $attendances = $this->getUserWorkingData($userId);
        $attendances = collect($attendances);
        $attendances = new LengthAwarePaginator(
            $attendances->forPage($request->page,5),
            count($attendances),
            5,
            $request->page,
            array('path' => $request->url())
        );

        return view('user-attendance', compact('user', 'attendances'));
    }

    public function userAfter(Request $request)
    {
        $userId = $request->userId;
        $page = $request->page;
        if($page == null) {
            $userId = $request->userId + 1;
        }
        $user = User::find($userId);
        $attendances = $this->getUserWorkingData($userId);
        $attendances = collect($attendances);
        $attendances = new LengthAwarePaginator(
            $attendances->forPage($request->page,5),
            count($attendances),
            5,
            $request->page,
            array('path' => $request->url())
        );

        return view('user-attendance', compact('user', 'attendances'));
    }
}
