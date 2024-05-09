@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Sensor Data Charts</h1>
    <div class="row">
        <div class="col-md-6">
            <h3>Temperature Chart (Bar)</h3>
            <canvas id="temperatureChart" width="400" height="400"></canvas>
        </div>
        <div class="col-md-6">
            <h3>Humidity Chart (Pie)</h3>
            <canvas id="humidityChart" width="400" height="400"></canvas>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Assuming you pass `temperatures` and `humidities` as arrays from the controller
    var tempCtx = document.getElementById('temperatureChart').getContext('2d');
    var humidityCtx = document.getElementById('humidityChart').getContext('2d');

    var temperatureChart = new Chart(tempCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!}, // e.g., ['Jan', 'Feb', 'Mar']
            datasets: [{
                label: 'Temperature (°C)',
                data: {!! json_encode($temperatures) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var humidityChart = new Chart(humidityCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($labels) !!}, // e.g., ['Jan', 'Feb', 'Mar']
            datasets: [{
                label: 'Humidity (%)',
                data: {!! json_encode($humidities) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        }
    });
</script>
@endsection
