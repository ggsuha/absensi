<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Traits\ImageHandling;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    use ImageHandling;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offset   = (($request->page ?? 1) - 1) * 10;
        $events = Event::offset($offset)->paginate(10);

        return view('admin.event.index', compact('events', 'offset'));
    }

    /**
     * Display a create page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');
    }

    /**
     * Store data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request['start'] = Carbon::createFromFormat('m/d/Y', $request->start)->format('Y-m-d');

            $event = new Event($request->input());

            $event->save();

            ini_set('memory_limit', '1024M');

            $imageName = $this->storeImage($request->logo, Event::IMAGE_FOLDER, null, true);

            $event->image()->create([
                'url' => $imageName
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            //delete stored image on storage
            if ($event) {
                $event->image->deleteImage();
            }

            DB::rollBack();

            throw $th;
        }
        
        return redirect()
                ->route('admin.event.edit', ['event' => $event->id])
                ->with('success', 'Event has been save!');
    }

    /**
     * Display a edit page.
     *
     * @return \App\Models\Event  $event
     */
    public function edit(Event $event)
    {
        return view('admin.event.edit', compact('event'));
    }

    /**
     * Update data.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        DB::beginTransaction();
        try {
            $request['start'] = Carbon::createFromFormat('m/d/Y', $request->start)->format('Y-m-d');

            $event->title       = $request->title;
            $event->description = $request->description;
            $event->start       = $request->start;

            $event->save();

            ini_set('memory_limit', '1024M');

            if ($request->logo) {
                $imageName = $this->storeImage($request->logo, Event::IMAGE_FOLDER, null, true);
    
                $event->image()->update([
                    'url' => $imageName
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;
        }
        
        return redirect()
                ->route('admin.event.edit', ['event' => $event->id])
                ->with('success', 'Event has been updated!');
    }

    /**
     * Delete data.
     *
     * @return \App\Models\Event  $event
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
                ->route('admin.event.index')
                ->with('success', 'Event has been deleted!');
    }
}
