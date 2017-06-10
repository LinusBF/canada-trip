@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a class="btn-primary btn" href="/location/create">Add new location</a>
                    <br>
                    <br>
                    @if($loc_count >= 1)
                        <a class="btn-primary btn" href="/post/create">New trip post</a>
                    @else
                        <button class="btn-primary btn" disabled>New trip post</button>
                        <p class="help-block">{{ __('messages.home_no_locations') }}</p>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Manage existing locations</div>

                <div class="panel-body">
                    <ul class="list-group">
                    @foreach($locations as $location)
                        <li class="list-group-item">
                            <a class="inline home_link" href="/location/{{ $location->id }}">{{ $location->name }}</a>
                            <a class="inline links home_link" href="/location/{{ $location->id }}/edit">Edit</a>
                            <a class="inline links delete-link" href="/location/{{ $location->id }}/delete">Delete</a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Manage existing posts</div>

                <div class="panel-body">
                    <ul class="list-group">
                        @foreach($posts as $post)
                            <li class="list-group-item">
                                <a class="inline home_link" href="/post/{{ $post->id }}">{{ $post->title }}</a>
                                <a class="inline links home_link" href="/post/{{ $post->id }}/edit">Edit</a>
                                <a class="inline links delete-link" href="/post/{{ $post->id }}/delete">Delete</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
