<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ Illuminate\Support\Facades\Storage::url('images/favicon.ico') }}">

    <title>{{$title ?? ''}}</title>

    <x-layouts.head-css>
        <x-slot:styles>
            {{ $styles  ?? ''}}
        </x-slot:styles>
    </x-layouts.head-css>
</head>
<body>

