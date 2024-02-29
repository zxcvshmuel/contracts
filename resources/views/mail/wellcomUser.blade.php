<x-mail::message>
    <p style="direction: rtl; text-align: right">
        ברוכים הבאים למערכת MySafe
        <br>
        שם משתמש: {{ $user->email }}
        <br>
        סיסמא: {{ $password }}
        <br>
        טלפון: {{ $user->phone }}
    </p>
    <x-mail::button :url="$url" color="success">
        לכניסה למערכת
    </x-mail::button>
    <p style="direction: rtl; text-align: right">
        תודה,<br>
        {{ config('app.name') }}
    </p>

</x-mail::message>
