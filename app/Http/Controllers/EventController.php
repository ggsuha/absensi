<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;


class EventController extends Controller
{
    /**
     * Display a detail page.
     *
     * @param string  $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        return view('user.event.show', compact('event'));
    }
    public function checkin(){
        return view('user.event.check-in');
    }

    public function scan_checkin(Request $request,$event){
        $event = Event::where('slug', $event)->firstOrFail();
        $participant = Participant::where('email', $request->email)->get()->first();
        
        $event->participants()->attach($participant->id, ['check_in' => now()]);
        $event->save();
        
        return response()->json([
            'name' => $participant->name
        ]);
    }
   
}
