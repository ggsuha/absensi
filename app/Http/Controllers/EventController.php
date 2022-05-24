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

    /**
     * Show check in page
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function checkin(string $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        return view('user.event.check-in', compact('event'));
    }

    /**
     * Update check in
     *
     * @param \Illuminate\Http\Request $request
     * @param int $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function scan_checkin(Request $request, $event)
    {
        $event = Event::findOrFail($event);

        $participant = $event->participants()->where('email', $request->email)->get()->first();
        
        if (!$participant) {
            return response()->json([
                'error' => "User dengan email {$request->email} tidak terdaftara di event ini."
            ]);
        }

        $event->participants()->updateExistingPivot($participant, ['check_in' => now()], false);

        return response()->json([
            'name' => $participant->name
        ]);
    }
}
