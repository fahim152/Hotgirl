@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">Real Time Sensor Data
            @if ($showAlert)
                <span class="alert alert-danger">Alert! Temp is HIGH !!!</span>
            @endif
        </h1>
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Timestamp</th>
                            <th>Temperature (°C)</th>
                            <th>Humidity (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $datum)
                            <tr>
                                <td>{{ $datum->timestamp }}</td>
                                <td>{{ $datum->temperature }}</td>
                                <td>{{ $datum->humidity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function(){
            window.location.reload(1);
        }, 2000);
    </script>

@endsection
