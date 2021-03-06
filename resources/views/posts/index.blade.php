@extends ('layouts.master')

@section ('content')
    <div class="fullscreen_trip_bg">
        <img src="{{ Storage::url($trip_parts[0][1]->image->path) }}">
    </div>
    <h2 class="location_title">{{ $trip_parts[0][1]->name }}</h2>
    <div class="trip_container">

        @php($old_loc_id = -1)
        @foreach($trip_parts as $index => $trip_part)
            @php($location = $trip_part[1])
            @php($post = $trip_part[0])

            @if($location->id != $old_loc_id)
                <div id="location_{{ $location->id }}" class="location_container flex-center in_view_trigger">
                    <input class="location_image" type="hidden" value="{{ Storage::url($location->image->path) }}" />
                    <input class="location_name" type="hidden" value="{{ $location->name }}" />
                    <div id="{{ $index === 0 ? "first_location" : ""}}" class="location_posts_container">
                @php($old_loc_id = $location->id)
            @endif
                    <div class="trip_post">
                        <div class="post_content">
                            <div class="post_text">
                                <h3>{{ $post->title }}</h3>
                                <p>{!! nl2br(e($post->content)) !!}</p>
                            </div>
                            <div class="post_image">
                                <img src="{{ Storage::url($post->images[0]->path) }}">
                            </div>
                        </div>
                    </div>
            @if(count($trip_parts) == ($index + 1) || $trip_parts[$index + 1][1]->id != $location->id)
                    </div>
                </div>
                @php($old_loc_id = $location->id)
            @endif

        @endforeach
        <footer>©Linus Bein Fahlander 2017</footer>
    </div>
@endsection