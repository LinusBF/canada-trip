@extends ('layouts.master')

@section ('content')

    @foreach($trip_parts as $trip_part)
        <h2>{{ $trip_part[0]->name }}</h2>
        <ul>
            @foreach($trip_part[1] as $place)
                <li>{{ $place->title }}</li>
            @endforeach
        </ul>
    @endforeach

@endsection