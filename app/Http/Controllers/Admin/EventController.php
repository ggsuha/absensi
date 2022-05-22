<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ParticipantExport;
use App\Http\Controllers\Controller;
use App\Imports\ParticipantImport;
use App\Mail\SendQrCode;
use App\Models\Event;
use App\Models\Participant;
use App\Traits\ImageHandling;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventController extends Controller
{
    use ImageHandling;

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
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
     * @param \App\Models\Event  $event
     * @return \Illuminate\Contracts\View\View
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

    /**
     * Display a listing of the participant resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function participant(Request $request, Event $event)
    {
        $offset   = (($request->page ?? 1) - 1) * 10;
        $participants = $event->participants()->offset($offset)->paginate(10);

        return view('admin.event.participant.index', compact('event', 'participants', 'offset'));
    }

    /**
     * Process participant export.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Event $event)
    {
        foreach ($event->participants as $participant) {
            if (!Storage::exists("public/upload/qr-codes/{$participant->email}.png")) {
                $code = QrCode::size(300)->generate($participant->email);
                Storage::put("public/upload/qr-codes/{$participant->email}.png", $code);
            }

            Mail::to($participant)->queue(new SendQrCode($event, $participant));
        }

        return redirect()
            ->route('admin.event.participant', ['event' => $event->id])
            ->with('success', 'Email sending is in process!');
    }

    /**
     * Process participant import.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request, Event $event)
    {
        DB::beginTransaction();

        try {
            $event->participants()->detach();

            Excel::import(new ParticipantImport, request()->file('file'));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        return redirect()
            ->route('admin.event.participant', ['event' => $event->id])
            ->with('success', 'Participant has been updated!');
    }

    /**
     * Process participant export.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request, Event $event)
    {
        return Excel::download(new ParticipantExport($event), "{$event->slug}-participant-collection.xlsx");
    }

    /**
     * Process participant export.
     *
     * @param \App\Models\Event $event
     * @param \App\Models\Participant $participant
     * @return \Illuminate\Http\Response
     */
    public function remove(Event $event, Participant $participant)
    {
        $event->participants()->detach($participant->id);

        return redirect()
            ->route('admin.event.participant', ['event' => $event->id])
            ->with('success', 'Participant has been removed from this event!');
    }

    /**
     * Process participant export.
     *
     * @param \App\Models\Event $event
     * @param \App\Models\Participant $participant
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function participantUpdate(Event $event, Participant $participant, Request $request)
    {
        DB::beginTransaction();
        try {
            $participant->name = $request->name;
            $participant->phone_code = $request->phone_code;
            $participant->phone = $request->phone;

            $participant->save();

            ini_set('memory_limit', '1024M');

            if ($request->file) {
                $imageName = $this->storeImage($request->file, Participant::IMAGE_FOLDER, null, true);

                $participant->image()->updateOrCreate([], [
                    'url' => $imageName
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        return redirect()
            ->route('admin.event.participant', ['event' => $event->id, 'page' => $request->page])
            ->with('success', 'Participant has been updated!');
    }
}
