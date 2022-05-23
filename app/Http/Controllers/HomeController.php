<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Show content
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke()
    {
        $events = Event::orderBy('start', 'desc')
            ->where('start', Carbon::today())
            ->limit(10)
            ->get();
        $ongoings = Event::orderBy('start', 'desc')
            ->where(
                'start',
                '<>',
                Carbon::today()
            )->limit(10)
            ->get();

        return view('user.home', compact('events', 'ongoings'));
    }
}
