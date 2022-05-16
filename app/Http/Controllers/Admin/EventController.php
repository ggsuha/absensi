<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Project;
use App\Traits\ImageHandling;
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
        $projects = Event::offset($offset)->paginate(10);

        return view('admin.event.index', compact('projects', 'offset'));
    }

    /**
     * Display a create page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.event.create');
    }

    /**
     * Display a create page.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $event = new Event($request->input());
            $event->save();

            ini_set('memory_limit', '1024M');

            $imageName = $this->storeImage($request->logo, Event::IMAGE_FOLDER, null, true);

            $event->image()->create([
                'url' => $imageName
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }
        
        // return redirect()
        //         ->route('admin.event.index')
        //         ->with('success', 'Event has been save!');
    }
}
