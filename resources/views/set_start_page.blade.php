@extends ('layouts.master')

@section ('content')
    <h2>{{ __('messages.set_start_title') }}</h2>

    <hr>

    <form method="POST" action="/images/start" enctype="multipart/form-data">
        {{ csrf_field() }}

        @include('layouts.errors')

        <div class="form-group">
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        {{ __('messages.set_start_add_images') }} <input type="file" style="display: none;" name="media">
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
                <input type="hidden" name="type" value="start_page">
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">{{ __('messages.set_start_add_post_btn') }}</button>

    </form>
@endsection