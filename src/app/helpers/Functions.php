<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Worktime;
use App\Models\Breaktime;

class Functions
{
    public static function status()
    {
        $user = Auth::user()->only(['id', 'name']);
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
    }
}