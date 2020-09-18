@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between">

                        <div class="col-3 p-2">
                            <img src="/svg/management.svg" style="max-height: 80px; float: left" class="card-img" alt="logo">
                        </div>
                        <div class="col-8 ml-4 float-right">
                            <h4>Admin Dashboard</h4>
                            <p>Rearrange reservations</p>
                        </div>
                    </div>
                    <div class="card-body table-responsive-md">
                        <table class="table table-sm table-hover">
                            <thead class="thead bg-success">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Beds</th>
                                    <th scope="col">Check-in</th>
                                    <th scope="col">Check-out</th>
                                    <th scope="col">Room #</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                    <tr class="table-light">
                                        <th scope="row">{{ $reservation->id }}</th>
                                        <td>{{ $reservation->email }}</td>
                                        <td>{{ $reservation->first_name }}</td>
                                        <td>{{ $reservation->last_name }}</td>
                                        <td>{{ $reservation->phone }}</td>
                                        <td>{{ $reservation->bed_qty }}</td>
                                        <td>{{ $reservation->check_in }}</td>
                                        <td>{{ $reservation->check_out }}</td>
                                        <td>{{ $reservation->rooms }}</td>
                                        <td><reservation-component reservation="reservation"></reservation-component></td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
