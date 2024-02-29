<x-mail::message>
    <p style="direction: rtl; text-align: right; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5;">
        שלום {{ $user->name }},<br>אנו שמחים לקבל אותך כמנוי לחבילה {{ $package->name }} ומודים לך על שבחרת בנו. <br>תוקף החבילה שלך יסתיים ב- {{ $user->active_until }}. <br>אנא פנה אלינו בכל שאלה או בקשה, נשמח לעזור.<br>בברכה,<br>צוות MySafe
    </p>

</x-mail::message>
