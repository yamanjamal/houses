<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>yaman</title>
         <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">
         <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>
    <body class=" bg-gray-200">
        @foreach ($user as $u)
            {{$u->name}}
            <br>
            {{$u->email}}
            <br>

            @foreach ($u->houses as $element)
                <br>
                {{$element->title}}
                <br>
            @endforeach
        @endforeach
{{--         @foreach ($houses as $h)
                <br>
                {{$h->title}}
                <br>
                {{$h->user->email}}
                <br>
        @endforeach --}}
    </body>
</html>
