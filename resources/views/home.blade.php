@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="col">
                        Welcome, make your reservation
                    </div>
                </div>
                <rooms-component
                    csrf="{{csrf_token()}}"
                    mindate="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                    mindateOut="{{\Carbon\Carbon::tomorrow()->format('Y-m-d')}}"
                >
                </rooms-component>

            </div>
        </div>
    </div>
</div>
@endsection
