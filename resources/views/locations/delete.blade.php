@extends ('layouts.master')

@section ('content')
    <form method="POST" action="/location/{{ $location->id }}/delete" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group" style="display: inline">
            <label>Are you sure you want to delete the location: {{ $location->name }}</label>
            <button class="btn btn-danger" type="submit">Yes</button>
            <a class="btn btn-primary" href="/home">No</a>
        </div>
    </form>
@endsection