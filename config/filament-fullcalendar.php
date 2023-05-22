<?php

/**
 * Consider this file the root configuration object for FullCalendar.
 * Any configuration added here, will be added to the calendar.
 * @see https://fullcalendar.io/docs#toc
 */

return [
    'timeZone' => config('app.timezone'),

    'locale' => config('app.locale'),

    'headerToolbar' => [
        'left' => 'title',
        'center' => 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
        'right' => 'prev,next today',
    ],

    'navLinks' => true,

    'editable' => true,

    'selectable' => true,

    'dayMaxEvents' => true,
];
