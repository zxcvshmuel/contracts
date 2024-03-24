<x-mail::message>
    <div style="background-color: #2cb4f34d; margin: auto; padding: 10px;">
        <h1 style="margin: auto!important; text-align: center!important;">{{ $contract->customer_name }} חתם על {{ $title }}</h1>
    <p style="text-align: right !important">
        מספר חוזה: {{ $contract->id }}
        <br>
        כותרת החוזה: {{ $contract->title }}
        <br>
        לצפיה בחוזה לחץ
        <a href="{{ $url }}" class="button button-primary" style="margin: auto; background-color: rgb(0 0 255)!important; border-color: rgb(0 0 255)!important" target="_blank" rel="noopener" >כאן </a>
    </p>







בכבוד רב
<br>
{{ config('app.name') }}
    </div>
</x-mail::message>
