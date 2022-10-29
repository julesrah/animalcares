<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Employee;
Use App\Models\Pets;
Use App\Models\Customer;
Use App\Models\User;
Use App\Models\Consultation;
Use App\Models\Injury;
Use App\DataTables\ConsultationDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use Validator;
use DB;
use Redirect;
use View;
use File;
use Storage;
use Auth;
use App\Events\SendConsultation;
use Event;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $consultation = Consultation::create($input);
    
        if(!(empty($request->injury_id))){
            $consultation->injuries()->attach($request->injury_id);
        }

        // Event::dispatch(new SendMail($user));
        return Redirect::to('/consultations')->with('success','Consultation complete!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consultation = Consultation::find($id);
        DB::table('consultinfo')->where('consultation_id',$id)->delete();
        $consultation->delete();
        return Redirect::to('/consultations')->with('success','Consultation deleted!');
    }

    public function getConsultations(ConsultationDataTable $dataTable) 
     {        
        $consultation =  Consultation::with(['injuries','pet','employee'])->get();
        $injuries = Injury::get();
        return $dataTable->render('consultation.consultations',compact('injuries'));
    }
}