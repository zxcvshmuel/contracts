<x-mail::message>
    <p style="direction: rtl; text-align: right">
        מסמך חדש נשלך אלך מאת מערכת MY-SAFE
        <br>
        לצפיה במסמך נא ללחוץ על הכפתור למטה
    </p>
    <x-mail::button :url="$url" color="success">
        לצפיה במסמך
    </x-mail::button>
    <p style="direction: rtl; text-align: right">
        תודה,<br>
        {{ config('app.name') }}
    </p>

</x-mail::message>
