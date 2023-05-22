<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\EventsResource;
use App\helpers;
use App\Models\Events;
use App\Models\Reminder;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget {

    public function createEvent(array $data): void
    {
        $user = auth()->user();
        // Create the event with the provided $data.

        Reminder::create([
            'user_id'    => $user->id,
            'title'      => $data['title'],
            'start_date' => $data['start'],
            'end_date'   => $data['end'],
        ]);

        try
        {
            if ($user->two_factor_secret)
            {
                $data = [
                    'title' => $data['title'],
                    'start' => $data['start'],
                    'end'   => $data['end'],
                ];

                helpers::createEvent($user, $data);
            }
        } catch (Exception $e)
        {
            Notification::send($user, ($e->getMessage()));
        }


    }

    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public function fetchEvents(array $fetchInfo): array
    {

        $user = auth()->user();

        $events = $user->events()->get();
        $remainders = $user->reminders()->get();

        if ($user->two_factor_secret !== null)
        {
            try
            {
                $googleEvents = helpers::getCalendarData($user);
            } catch (\Exception $e)
            {
                $googleEvents = [];
            }
        } else
        {
            $googleEvents = [];
        }

        $results = [];

        foreach ($events as $event)
        {
            $results[] = [
                'type'  => 'event', // 'reminder
                'id'    => $event->id,
                'title' => $event->title,
                'start' => $event->date,
                'end'   => $event->end_at,
                'url'   => route('filament.resources.events.edit', $event->id),
            ];
        }

        foreach ($remainders as $remainder)
        {
            $results[] = [
                'type'  => 'reminder', // 'reminder
                'id'    => $remainder->id * 100000,
                'title' => $remainder->title,
                'start' => $remainder->start_date,
                'end'   => $remainder->end_date,
                'url'   => '',
            ];
        }

        foreach ($googleEvents as $googleEvent)
        {

          $results[] = [
            'type' => 'google',
            'id' => $googleEvent['id'],
            'title' => $googleEvent['summary'],
            'start' => $googleEvent['start']['dateTime'] ?? $googleEvent['start']['date'],
            'end' => $googleEvent['end']['dateTime'] ?? $googleEvent['end']['date'],
            'url' => '',
            'extendedProps' => [
              'googleEvent' => true,
            ],
          ];
        }


        return $results;
    }


    protected static function getCreateEventFormSchema(): array
    {
        return [
            TextInput::make('title')->required(),
            \Filament\Forms\Components\DateTimePicker::make('start')->required()->closeOnDateSelection(),
            \Filament\Forms\Components\DateTimePicker::make('end')->default(null)->closeOnDateSelection(),
        ];
    }

    protected static function getEditEventFormSchema(): array
    {
        return [
            TextInput::make('title')->required(),
            DateTimePicker::make('start')->required()->closeOnDateSelection(),
            DateTimePicker::make('end')->default(null)->closeOnDateSelection(),
        ];
    }

    public function editEvent(array $data): void
    {
        // Update the event with the provided $data.
        if ($this->editEventFormState['extendedProps']['type'] == 'reminder')
        {
            $event = Reminder::find($this->editEventFormState['id'] / 100000);
            $event->title = $data['title'];
            $event->start_date = $data['start'];
            $event->end_date = $data['end'];
            $event->save();
            $this->refreshEvents();
        } else
        {
            if ($this->editEventFormState['extendedProps']['type'] == 'event')
            {
                $event = Events::find($this->editEventFormState['id']);
                $event->title = $data['title'];
                $event->date = $data['start'];
                $event->end_at = $data['end'];
                $event->save();
                $this->refreshEvents();
            } else
            {
              if ($this->editEventFormState['extendedProps']['type'] == 'google')
              {
                Notification::make()
                  ->title('לא ניתן לערוך אירוע ביומן גוגל')
                  ->success()
                  ->send();
              }
            }
        }
        $this->refreshEvents();
    }

    // Resolve Event record into Model property
    public function resolveEventRecord(array $data)
    {

        if ($data['extendedProps']['type'] == 'event')
        {
            return Events::find($data['id']);
        } else
        {
            if ($data['extendedProps']['type'] == 'reminder')
            {
                return Reminder::find($data['id']);
            } else
            {
              return new Events([
                'title'  => $data['title'],
                'date'   => $data['start'],
                'end_at' => $data['end'],
              ]);
            }
        }
    }
}

