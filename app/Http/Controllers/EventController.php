<?php

namespace App\Http\Controllers;

use App\Models\Event;

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
}
