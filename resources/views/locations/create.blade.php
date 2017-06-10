@extends ('layouts.master')

@section ('content')
    <h2>{{ __('messages.location_create_title') }}</h2>

    <hr>

    <form method="POST" action="/locations" enctype="multipart/form-data">
        {{ csrf_field() }}

        @include('layouts.errors')

        <div class="form-group">
            <label for="locationNameInput">{{ __('messages.location_create_name') }}</label>
            <input type="text" class="form-control" id="locationNameInput" name="name">
        </div>
        <div class="form-group">
            <label for="locationCoordsInput">{{ __('messages.location_create_coords') }}</label>
            <input class="form-control" id="locationCoordsInput" name="coordinates">
        </div>
        <div class="form-group">
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        {{ __('messages.location_create_add_image') }} <input type="file" style="display: none;" name="image">
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
                <input type="hidden" name="type" value="background">
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">{{ __('messages.location_create_add_post_btn') }}</button>

    </form>
@endsection