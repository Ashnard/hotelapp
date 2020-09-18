@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($groups as $key => $group)
        <div class="card">
            <div class="card-header">Option #{{$key+1}}
                <button class="btn btn-outline-primary float-right">Select</button>
            </div>
            <div class="card-body">
                <ul>
                    @foreach($group as $room)
                        <li>{{ $room->name }} (#{{ $room->room_num }})</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection
