<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Pets;
Use App\Models\Customer;
Use App\Models\Consultation;
Use App\DataTables\PetDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use App\Rules\ExcelRule;
use App\Imports\PetImport;
use DB;
use Redirect;
use View;
use Excel;
use Validator;
use File;
use Storage;
use Auth;

class PetsController extends Controller
{
    //

	public function create()
    {
        return View::make('pet.create');
    }

	public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
             'image' => ['mimes:jpeg,png,jpg,gif,svg' ]
        ]);

        if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images' ;
            $input['img_path'] = 'images/'.$fileName;
           
            $file->move($destinationPath,$fileName); 
        }
        Pets::create($input);
        return Redirect::to('/home')->with('success','New Pet Added!'); 
   }

   public function shows($id)
    {
        // $pets = Pets::find($id);
        // return view('pets.show',compact('pets'));

         // $pets = DB::table('pets')

         //    ->leftJoin('customers','customers.id','=','pets.customer_id')
         //    ->select('pets.id','customers.fname','customers.lname','pets.name','pets.type','pets.breed','pets.img_path')
         //    ->where('pets.id', '=', $id)
         //    ->get();

        $pets = Pets::find($id);
        $consult = Consultation::where('pet_id',($id))->get();

        return view('pet.shows', compact('pets', 'consult'));
    }

	public function edit($id)
	    {
	        $pets = Pets::find($id);
	        return View::make('pet.edit',compact('pets'));
	    }


	public function update(Request $request, $id)
    {
       $pet = Pets::find($id);

        $validator = Validator::make($request->all(), Pets::$rulesss);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {
                        $path = Storage::putFileAs('images/', $request->file('image'),$request->file('image')->getClientOriginalName());


                        $request->merge(["img_path"=>$request->file('image')->getClientOriginalName()]);


                        $input = $request->all();

                        if($file = $request->hasFile('image')) {
                            $file = $request->file('image') ;
                            $fileName = $file->getClientOriginalName();
                            $destinationPath = public_path().'/images' ;
                            // dd($fileName);
                            $input['img_path'] = 'images/'.$fileName;            
                            $pet->update($input);
                            // dd($customer);
                            $file->move($destinationPath,$fileName);
                            return Redirect::to('/home')->with('success','Pet has been updated!');
                        } 
                    }
    }

	public function destroy($id)
    {
        $pets= Pets::find($id);
        $pets->delete();

        return Redirect::to('/pets')->with('success','Pet Deleted!');
    }

    public function getPets(PetDataTable $dataTable) 
     {        
        $pets = Pets::with(['customer'])->get();
        //dd($pets);
        return $dataTable->render('pet.pets');
    }

    public function import(Request $request) {     
        
        Excel::import(new PetImport, request()->file('pet_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }





}


