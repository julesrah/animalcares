<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Chart;
use DB;
use View;
use App\Charts\Groom;

class GroomedchartController extends Controller
{
 public function index(){

    $chartt = DB::table('orderinfo')
    ->join('orderline','orderinfo.id','orderline.orderinfo_id')
    ->join('services','services.id','orderline.service_id')
    ->groupBy('services.description')
    ->pluck(DB::raw('count(services.description) as total'),'services.description')
    ->toArray();
    dd($chartt);

$groomingChart = new Groom;

$dataset = $groomingChart->labels(array_keys($chartt));

$dataset = $groomingChart->dataset('Number of Pets Groomed', 'bar', array_values($chartt));
$dataset = $dataset->backgroundColor(collect(['#900020']));
$groomingChart->options([
    'responsive' => true,
    
    'tooltips' => ['enabled'=> true],

    'title' => [
        'display'=> true,
        'text' => ''
      ],

    'aspectRatio' => 1,
    'scales' => [
        'yAxes'=> [[
                    'display'=>true,
                    'ticks'=> ['beginAtZero'=> true],
                    'gridLines'=> ['display'=> true],
                  ]],
            'xAxes'=> [[
                    'categoryPercentage'=> 0.8,
                    //'barThickness' => 100,
                    'barPercentage' => 1,
                    'ticks' => ['beginAtZero' => false],
                    'gridLines' => ['display' => true],
                    'display' => true

                  ]],
    ],
  '{outlabels: {display: true}}',
]);

return view('chart.show', compact('groomingChart') );
 }

 public function date(Request $request){

    // dd($request->all());

    $chartt = DB::table('orderinfo')
    ->join('orderline','orderinfo.id','orderline.orderinfo_id')
    ->join('services','services.id','orderline.service_id')
    ->groupBy('services.description')
    ->whereBetween('orderinfo.created_at',[$request->start, $request->end])
    ->pluck(DB::raw('count(services.description) as total'),'services.description')
    ->toArray();

$groomingChart = new Groom;

$dataset = $groomingChart->labels(array_keys($chartt));

$dataset = $groomingChart->dataset('Count of Pets Groomed', 'bar', array_values($chartt));
$dataset = $dataset->backgroundColor(collect(['#900020']));
$groomingChart->options([
    'responsive' => true,

    'tooltips' => ['enabled'=> true],

    'title' => [
        'display'=> true,
        'text' => ''
      ],

    'aspectRatio' => 1,
    'scales' => [
        'yAxes'=> [[
                    'display'=>true,
                    'ticks'=> ['beginAtZero'=> true],
                    'gridLines'=> ['display'=> true],
                  ]],
            'xAxes'=> [[
                    'categoryPercentage'=> 0.8,
                    //'barThickness' => 100,
                    'barPercentage' => 1,
                    'ticks' => ['beginAtZero' => false],
                    'gridLines' => ['display' => true],
                    'display' => true

                  ]],
    ],
  '{outlabels: {display: true}}',
]);


return view('chart.show', compact('groomingChart') );
 }

public function showdate(){
    return view('chart.datepicker');
}

}