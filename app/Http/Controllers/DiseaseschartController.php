<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Chart;
use DB;
use View;
use App\Charts\Diseases;

class DiseaseschartController extends Controller
{
    public function index(){

        $chartt = DB::table('consultation')
        ->join('consultinfo','consultation.id','consultinfo.consultation_id')
        ->join('injuries','consultinfo.injury_id','injuries.id')
        ->groupBy('injuries.description')
        ->pluck(DB::raw('count(injuries.description) as total'),'injuries.description')
        ->toArray();
        dd($chartt);

    $petChart = new Diseases;

    $dataset = $petChart->labels(array_keys($chartt));

    $dataset = $petChart->dataset('Count of Diseases', 'bar', array_values($chartt));
    $dataset = $dataset->backgroundColor(collect(['#900020']));
    $petChart->options([
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

    return view('chart.petchart', compact('petChart') );
     }
}