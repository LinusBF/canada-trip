@extends ('layouts.master')

@section ('content')
    <h2>{{ __('messages.post_create_title') }}</h2>

    <hr>

    <form method="POST" action="/posts" enctype="multipart/form-data">
        {{ csrf_field() }}

        @include('layouts.errors')

        <div class="form-group">
            <label for="postTitleInput">{{ __('messages.post_create_input_title') }}</label>
            <input type="text" class="form-control" id="postTitleInput" name="title">
        </div>
        <div class="form-group">
            <label for="postLocInput">{{ __('messages.post_create_input_loc_title') }}</label>
            <select id="postLocInput" title="{{ __('messages.post_create_select_loc') }}" name="location">
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="postDateInput">{{ __('messages.post_create_input_date_title') }}</label>
            <input type="date" class="form-control" id="postDateInput" name="date">
        </div>
        <div class="form-group">
            <label for="postContentInput">{{ __('messages.post_create_input_content_title') }}</label>
            <textarea class="form-control" id="postContentInput" rows="5" name="content" placeholder="{{ __('messages.post_create_text_placeholder') }}"></textarea>
        </div>
        <div class="form-group">
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        {{ __('messages.post_create_add_images') }} <input type="file" style="display: none;" name="images[]" multiple>
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
                <input type="hidden" name="type" value="gallery">
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">{{ __('messages.post_create_add_post_btn') }}</button>

    </form>
@endsection