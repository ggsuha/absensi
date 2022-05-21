<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ParticipantExport implements FromQuery, WithColumnFormatting, WithMapping, ShouldAutoSize, WithHeadings, WithStyles
{
    use Exportable;

    /**
     * construct function
     *
     * @param \App\Models\Event $event
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * heading
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone Number',
        ];
    }

    /**
     * style
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet): array
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    /**
     * query function
     *
     * @return \\Illuminate\Support\Collection
     */
    public function query()
    {
        return $this->event->participants();
    }

    /**
     * map
     *
     * @param mixed $participant
     * @return array
     */
    public function map($participant): array
    {
        return [
            $participant->name,
            $participant->email,
            $participant->phone_with_prefix,
        ];
    }

    /**
     * format column
     *
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
