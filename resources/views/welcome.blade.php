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
            @if($image != null)
                @if(!starts_with($image->path, 'public/')) <!-- Figure out a smoother way of doing this, column in DB? -->
                    <div class="youtube-foreground">
                        <iframe src="https://www.youtube.com/embed/{{ $image->path }}?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&playlist={{ $image->path }}"
                                frameborder="0" allowfullscreen="allowfullscreen"
                                mozallowfullscreen="mozallowfullscreen"
                                msallowfullscreen="msallowfullscreen"
                                oallowfullscreen="oallowfullscreen"
                                webkitallowfullscreen="webkitallowfullscreen">
                        </iframe>
                    </div>
                @elseif(ends_with($image->path, '.mp4'))
                    <video loop muted autoplay class="fullscreen-bg__video">
                        <source src="{{ Storage::url($image->path) }}" type="video/mp4">
                    </video>
                @elseif(ends_with($image->path, '.jpg'))
                    <img class="fullscreen-bg__video" src="{{ Storage::url($image->path) }}">
                @elseif(ends_with($image->path, '.png'))
                    <img class="fullscreen-bg__video" src="{{ Storage::url($image->path) }}">
                @endif
            @endif
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
