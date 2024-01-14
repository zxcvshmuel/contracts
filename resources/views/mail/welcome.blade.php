<x-mail::message>
    <p style="direction: rtl; text-align: right">
        משתמש חדש נרשם דרך עמוד הבית של המערכת MY-SAFE
        <br>
        שם: {{ $user->name }}
        <br>
        מייל: {{ $user->email }}
        <br>
        טלפון: {{ $user->phone }}
    </p>
    <x-mail::button :url="$url" color="success">
        לצפיה במשתמש
    </x-mail::button>
    <p style="direction: rtl; text-align: right">
        תודה,<br>
        {{ config('app.name') }}
    </p>

</x-mail::message>
