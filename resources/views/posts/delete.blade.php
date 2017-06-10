@extends ('layouts.master')

@section ('content')
    <form method="POST" action="/post/{{ $post->id }}/delete" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group" style="display: inline">
            <label>Are you sure you want to delete the post: {{ $post->title }}</label>
            <button class="btn btn-danger" type="submit">Yes</button>
            <a class="btn btn-primary" href="/home">No</a>
        </div>
    </form>
@endsection