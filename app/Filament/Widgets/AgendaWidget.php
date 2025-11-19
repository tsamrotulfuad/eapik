<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Agenda;
use App\Filament\Resources\AgendaResource;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class AgendaWidget extends FullCalendarWidget
{ 
    public function fetchEvents(array $fetchInfo): array
    {
        return Agenda::query()
            ->whereDate('tanggal_agenda', '>=', $fetchInfo['start'])
            ->whereDate('tanggal_agenda', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn (Agenda $event) => [
                    'id'    => $event->id,
                    'title' => $event->nama_agenda,

                    'start' => Carbon::parse(
                        $event->tanggal_agenda . ' ' . $event->mulai
                    )->toIso8601String(),

                    'end' => Carbon::parse(
                        $event->tanggal_agenda . ' ' . $event->selesai
                    )->toIso8601String(),
                    
                    'url' => AgendaResource::getUrl(name: 'edit', parameters: ['record' => $event]),
                    'shouldOpenUrlInNewTab' => true
                ]
            )
            ->all();
    }

    public function config(): array
    {
        return [
            'firstDay' => 1,
            'headerToolbar' => [
                'left' => 'dayGridWeek,dayGridDay',
                'center' => 'title',
                'right' => 'prev,next today',
            ],
        ];
    }

}
