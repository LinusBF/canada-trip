@extends ('layouts.master')

@section ('content')
    <h2>{{ __('messages.location_edit_title') }}</h2>

    <hr>

    <form method="POST" action="/location/{{ $location->id }}/update" enctype="multipart/form-data">
        {{ csrf_field() }}

        @include('layouts.errors')

        <div class="form-group">
            <label for="postTitleInput">{{ __('messages.location_edit_change_title') }}</label>
            <input type="text" class="form-control" id="postTitleInput" name="name" value="{{ $location->name }}">
        </div>
        <div class="form-group">
            <label for="postDateInput">{{ __('messages.location_create_coords') }}</label>
            <input type="text" class="form-control" id="postDateInput" name="coords" value="{{ $location->coordinates }}">
        </div>
        <div class="form-group">
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        {{ __('messages.location_edit_add_images') }} <input type="file" style="display: none;" name="image">
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
                <input type="hidden" name="type" value="background">
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">{{ __('messages.location_edit_location_btn') }}</button>

    </form>

@endsection