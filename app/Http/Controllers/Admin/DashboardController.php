<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $upcoming = Event::where('start', '>', Carbon::today())->get()->count();
        $finished = Event::where('start', '<', Carbon::today())->get()->count();
        $participant = Participant::get()->count();

        return view('admin.dashboard', compact('upcoming', 'finished', 'participant'));
    }
}
