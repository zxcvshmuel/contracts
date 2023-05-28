@php($locale = strtolower(str_replace('_', '-', $this->config('locale', config('app.locale')))))

<x-filament::widget>
    <x-filament::card>

        <x-slot name="header">
            <x-filament::card.heading>
                <h5 style="display: flex; justify-content: space-evenly;">
                    <div class="event dot">- אירוע</div>
                    <div class="remainder dot">- תזכורת</div>
                    <div class="google dot">- יומן גוגל</div>
                </h5>
            </x-filament::card.heading>
        </x-slot>

        <video class="sm:hiden" id="fullCalendarVideo"
               style="position: absolute; width: -webkit-fill-available; height: auto; opacity: 0.15" autoplay muted
               loop>
            <source src="{{\Illuminate\Support\Facades\Storage::url('/') . 'time-management-5536231-4629529.mp4' }}"
                    type="video/mp4">
        </video>

        <style>
            .event.dot::before {
                content: "\2022"; /* Add content: \2022 is the CSS Code/unicode for a bullet */
                color: red; /* Change the color */
                font-weight: bolder; /* If you want it to be bold */
                display: inline-block; /* Needed to add space between the bullet and the text */
                width: 1em; /* Also needed for space (tweak if needed) */
                margin-right: 0.5em; /* Also needed for space (tweak if needed) */
            }

            .remainder.dot::before {
                content: "\2022"; /* Add content: \2022 is the CSS Code/unicode for a bullet */
                color: blue; /* Change the color */
                font-weight: bold; /* If you want it to be bold */
                display: inline-block; /* Needed to add space between the bullet and the text */
                width: 1em; /* Also needed for space (tweak if needed) */
                margin-right: 0.5em; /* Also needed for space (tweak if needed) */
            }

            .google.dot::before {
                content: "\2022"; /* Add content: \2022 is the CSS Code/unicode for a bullet */
                color: green; /* Change the color */
                font-weight: bold; /* If you want it to be bold */
                display: inline-block; /* Needed to add space between the bullet and the text */
                width: 1em; /* Also needed for space (tweak if needed) */
                margin-right: 0.5em; /* Also needed for space (tweak if needed) */
            }

            @media (max-width: 650px) {
                .filament-fullcalendar--calendar {
                    min-height: 100vh;
                }

                #fullCalendarVideo {
                    top: 65%;
                }

                .filament-main-content, .filament-main-content .px-4, .filament-main-content .p-2.space-y-2 {
                    padding: 1px !important;
                }
            }
        </style>
        <script>
            document.querySelector('#fullCalendarVideo').playbackRate = 0.1;
        </script>
        <div
            wire:ignore
            x-ref="calendar"
            x-data="calendarComponent({
                key: @js($this->getKey()),
                config: {{ json_encode($this->getConfig(), JSON_PRETTY_PRINT) }},
                locale: '{{ $locale }}',
                events: {{ json_encode($events) }},
                initialView: @js($this->config('initialView')),
                initialDate: @js($this->config('initialDate')),
                shouldSaveState: @js($this->config('saveState', false)),
                handleEventClickUsing: async ({ event, jsEvent }) => {
                    if( $data.calendar.view.type == 'dayGridMonth') {
                        jsEvent.preventDefault();
                        $data.calendar.changeView('timeGridDay', event.startStr);
                        return false;
                    } else if( event.url ) {
                        jsEvent.preventDefault();
                        window.open(event.url, event.extendedProps.shouldOpenInNewTab ? '_blank' : '_self');
                        return false;
                    }

                    @if ($this::isListeningClickEvent())
                        $wire.onEventClick(event)
                    @endif
                },
                handleEventDropUsing: async ({ event, oldEvent, relatedEvents }) => {
                    @if($this::isListeningDropEvent())
                        $wire.onEventDrop(event, oldEvent, relatedEvents)
                    @endif
                },
                handleEventResizeUsing: async ({ event, oldEvent, relatedEvents }) => {
                    @if($this::isListeningResizeEvent())
                        $wire.onEventResize(event, oldEvent, relatedEvents)
                    @endif
                },
                handleDateClickUsing: async ({ date, allDay }) => {
                    @if($this::canCreate())
                        $wire.onCreateEventClick({ date, allDay })
                    @endif
                },
                handleSelectUsing: async ({ start, end, allDay }) => {
                    @if($this->config('selectable', false))
                        $wire.onCreateEventClick({ start, end, allDay })
                    @endif
                },
                fetchEventsUsing: async ({ start, end, allDay }, successCallback, failureCallback) => {
                    @if( $this::canFetchEvents() )
                        return $wire.fetchEvents({ start, end, allDay })
                            .then(events => {
                                if(events.length == 0) return Object.values($data.cachedEvents)
                                if(events[0].id) {
                                    events.forEach((event) => $data.cachedEvents[event.id] = event)
                                    successCallback(Object.values($data.cachedEvents))
                                } else{
                                    successCallback(events)
                                }
                            })
                            .catch( failureCallback );
                    @else
                        return successCallback([]);
                    @endif
                },
            })"
            x-on:filament-fullcalendar--refresh.window="
                @if( $this::canFetchEvents() )
                    $data.calendar.refetchEvents();
                @else
                    $data.calendar.removeAllEvents();
                    event.detail.data.map(event => $data.calendar.addEvent(event));
                @endif
            "
            class="filament-fullcalendar--calendar"
        ></div>
    </x-filament::card>

    @if($this::canCreate())
        <x:filament-fullcalendar::create-event-modal/>
    @endif

    @if($this::canView())
        <x:filament-fullcalendar::edit-event-modal/>
    @endif
</x-filament::widget>
