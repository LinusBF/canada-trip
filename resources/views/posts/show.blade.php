@extends ('layouts.master')

@section ('content')
    <div class="fullscreen_trip_bg">
        <img src="/storage/{{ $post->location->image->path }}">
    </div>
    <h2 class="location_title">{{ $post->location->name }}</h2>
    <div class="post_container">
        <div class="location_posts_container">
            <div class="trip_post_solo">
                <div class="post_content">
                    <div class="post_text">
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->content }}</p>
                    </div>
                    <img src="/storage/{{ $post->images[0]->path }}">
                </div>
            </div>
            @if(count($post->images) > 1)
                <div class="post_gallery">
                    <div class="gallery_point_left"></div>
                    @foreach($post->images->all() as $image)
                        <div class="gallery_image_container">
                            @if($image == $post->images[0])
                                <img class="current_image" src="/storage/{{ $image->path }}">
                            @else
                                <img src="/storage/{{ $image->path }}">
                            @endif
                        </div>
                    @endforeach
                    <div class="gallery_point_right"></div>
                </div>
            @endif
        </div>
    </div>
@endsection