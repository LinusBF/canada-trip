@extends ('layouts.master')

@section ('content')
    <h2>{{ __('messages.set_start_title') }}</h2>

    <hr>

    <form method="POST" action="/images/start" enctype="multipart/form-data">
        {{ csrf_field() }}

        @include('layouts.errors')

        <input type="hidden" name="type" value="start_page">

        <div class="form-group">
            <div class="input-group">
                <label>
                    <h4>{{ __('messages.set_start_lbl_media_type') }}</h4>
                    <div class="btn-group" data-toggle="buttons">
                        <label id="media-type-select-image" class="btn btn-primary active">
                            <input class="radio-inline" type="radio" name="media_type" value="image" checked>
                            {{ __('messages.set_start_radio_image') }}
                        </label>
                        <label id="media-type-select-video" class="btn btn-primary">
                            <input class="radio-inline" type="radio" name="media_type" value="video">
                            {{ __('messages.set_start_radio_video') }}
                        </label>
                    </div>
                </label>
            </div>
        </div>

        <div id="input-select-image" class="form-group">
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        {{ __('messages.set_start_add_images') }} <input type="file" style="display: none;" name="media">
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
            </div>
        </div>

        <div id="input-select-video" class="form-group hidden">
            <div class="input-group">
                <label>
                    {{ __('messages.set_start_lbl_media_link') }}
                    <input type="text" name="media_link">
                </label>
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">{{ __('messages.set_start_add_post_btn') }}</button>

    </form>
@endsection