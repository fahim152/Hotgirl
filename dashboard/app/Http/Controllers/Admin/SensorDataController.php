<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SensorData;
use Illuminate\Support\Facades\DB;

class SensorDataController extends Controller
{
    public function index()
    {
        $data = SensorData::orderBy('timestamp', 'desc')
        ->take(20)
        ->get();

         $temperatureThreshold = 26;
         $humidityThreshold = 60;

         $showAlert = false;
         if ($data->first() && ($data->first()->temperature > $temperatureThreshold)) {
             $showAlert = true;
         }
        return view('sensorData', compact('data', 'showAlert')); // Return it to the view
    }

    public function showCharts()
    {
        $data = SensorData::select(
            DB::raw("avg(temperature) as avg_temp"),
            DB::raw("avg(humidity) as avg_hum"),
            DB::raw("date_format(timestamp, '%Y-%m') as month")
        )
        ->groupBy('month')
        ->get();

        $labels = $data->pluck('month');
        $temperatures = $data->pluck('avg_temp');
        $humidities = $data->pluck('avg_hum');

        return view('chart', compact('labels', 'temperatures', 'humidities'));
    }

}
