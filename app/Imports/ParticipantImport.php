<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Row;

class ParticipantImport implements OnEachRow, WithUpserts, WithHeadingRow
{
    /**
     * @param \Maatwebsite\Excel\Row $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function onRow(Row $row)
    {
        $row      = $row->toArray();
        $phone = phone_map($row['phone_number']);

        $participant = Participant::updateOrCreate(
            [
                'email'      => $row['email']
            ],
            [
                'name'       => $row['name'],
                'phone'      => $phone['number'],
                'phone_code' => $phone['code'],
            ]
        );

        $event = request()->event;

        $event->participants()->attach($participant->id, ['check_in' => $row['check_in'] == '-' ? null : $row['check_in']]);
        $event->save();

        return $participant;
    }

    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'email';
    }
}
