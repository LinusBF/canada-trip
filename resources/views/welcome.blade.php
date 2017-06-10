<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="fullscreen-bg">
            <video loop muted autoplay poster="{{ url('/storage/bg_video_frame.png') }}" class="fullscreen-bg__video">
                <source src="{{ url('/storage/bg_video.mp4') }}" type="video/mp4">
            </video>
        </div>

        <div class="front-overlay flex-center position-ref full-height full-width">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Admin</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ __('messages.page_title') }}
                </div>
                <div class="m-b-md links">
                    <a href="/trip">{{ __('messages.see_trip_btn') }}</a>
                </div>

            </div>
        </div>
    </body>
</html>
