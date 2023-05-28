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


    /*public function getViewData(): array
    {
        $user = auth()->user();

        $events = $user->events()->get();
        $remainders = $user->reminders()->get();

        if ($user->two_factor_secret !== null)
        {
            try
            {
                $googleEvents = Helpers::getCalendarData($user);
            } catch (\Exception $e)
            {
                $googleEvents = [];
            }
        } else
        {
            $googleEvents = [];
        }

        $uniqueEventIds = [];
        $results = [];

        foreach ($events as $event) {
            if (!in_array($event->id, $uniqueEventIds)) {
                $uniqueEventIds[] = $event->id;

                // Add the event to the results array
                $results[] = [
                    'type'  => 'event',
                    'id'    => $event->id,
                    'title' => $event->title,
                    'start' => $event->date,
                    'end'   => $event->end_at,
                    'url'   => route('filament.resources.events.edit', $event->id),
                ];
            }
        }

        foreach ($remainders as $remainder) {
            $uniqueRemainderId = $remainder->id * 100000;

            if (!in_array($uniqueRemainderId, $uniqueEventIds)) {
                $uniqueEventIds[] = $uniqueRemainderId;

                // Add the remainder to the results array
                $results[] = [
                    'type'  => 'remainder',
                    'id'    => $uniqueRemainderId,
                    'title' => $remainder->title,
                    'start' => $remainder->start_date,
                    'end'   => $remainder->end_date,
                    'url'   => '',
                ];
            }
        }

        $eventKeys = [];

        foreach ($results as $result) {
            $eventKeys[$result['title'] . '_' . $result['start'] . '_' . $result['end']] = true;
        }

        foreach ($googleEvents as $googleEvent) {
            $eventKey = $googleEvent['summary'] . '_' . ($googleEvent['start']['dateTime'] ?? $googleEvent['start']['date']) . '_' . ($googleEvent['end']['dateTime'] ?? $googleEvent['end']['date']);
            if (false && array_search($eventKey, $eventKeys) !== false) {
                // האירוע כבר קיים במערך, ניתן לבצע פעולות נוספות כאן
            } else {
                // האירוע לא קיים במערך, ניתן להוסיף אותו לתוצאות
                $results[] = [
                    'type'  => 'google',
                    'id'    => $googleEvent['id'],
                    'title' => $googleEvent['summary'],
                    'start' => $googleEvent['start']['dateTime'] ?? $googleEvent['start']['date'],
                    'end'   => $googleEvent['end']['dateTime'] ?? $googleEvent['end']['date'],
                    'url'   => '',
                    'extendedProps'       => [
                        'googleEvent' => true,
                    ],
                ];
            }
        }

        return $results;
    }*/

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
        $this->refreshEvents();
        try
        {
            if ($user->two_factor_secret)
            {
                $data = [
                    'title' => $data['title'],
                    'start' => $data['start'],
                    'end'   => $data['end'],
                ];

                Helpers::createEvent($user, $data);
                $this->refreshEvents();
            }
        } catch (Exception $e)
        {
            $this->refreshEvents();
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
                $googleEvents = Helpers::getCalendarData($user);
            } catch (\Exception $e)
            {
                $googleEvents = [];
            }
        } else
        {
            $googleEvents = [];
        }

        $uniqueEventIds = [];
        $results = [];

        foreach ($events as $event) {
            if (!in_array($event->id, $uniqueEventIds)) {
                $uniqueEventIds[] = $event->id;

                // Add the event to the results array
                $results[] = [
                    'type'  => 'event',
                    'id'    => $event->id,
                    'title' => $event->title,
                    'start' => $event->date,
                    'end'   => $event->end_at,
                    'url'   => route('filament.resources.events.edit', $event->id),
                ];
            }
        }

        foreach ($remainders as $remainder) {
            $uniqueRemainderId = $remainder->id * 100000;

            if (!in_array($uniqueRemainderId, $uniqueEventIds)) {
                $uniqueEventIds[] = $uniqueRemainderId;

                // Add the remainder to the results array
                $results[] = [
                    'type'  => 'remainder',
                    'id'    => $uniqueRemainderId,
                    'title' => $remainder->title,
                    'start' => $remainder->start_date,
                    'end'   => $remainder->end_date,
                    'url'   => '',
                ];
            }
        }

        $eventKeys = [];

        foreach ($results as $result) {
            $eventKeys[$result['title'] . '_' . $result['start'] . '_' . $result['end']] = true;
        }

        foreach ($googleEvents as $googleEvent) {
            $eventKey = $googleEvent['summary'] . '_' . ($googleEvent['start']['dateTime'] ?? $googleEvent['start']['date']) . '_' . ($googleEvent['end']['dateTime'] ?? $googleEvent['end']['date']);
            if (false && array_search($eventKey, $eventKeys) !== false) {
                // האירוע כבר קיים במערך, ניתן לבצע פעולות נוספות כאן
            } else {
                // האירוע לא קיים במערך, ניתן להוסיף אותו לתוצאות
                $results[] = [
                    'type'  => 'google',
                    'id'    => $googleEvent['id'],
                    'title' => $googleEvent['summary'],
                    'start' => $googleEvent['start']['dateTime'] ?? $googleEvent['start']['date'],
                    'end'   => $googleEvent['end']['dateTime'] ?? $googleEvent['end']['date'],
                    'url'   => '',
                    'extendedProps'       => [
                        'googleEvent' => true,
                    ],
                ];
            }
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
        if ($this->editEventFormState['extendedProps']['type'] == 'remainder')
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
            if ($data['extendedProps']['type'] == 'remainder')
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

