<?php

namespace App\Http\Controllers;

Use App\Models\Employee;
Use App\Models\Pet;
Use App\Models\User;
use Illuminate\Http\Request;
Use App\DataTables\EmployeeDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Redirect;
use View;
use Excel;
use File;
use Storage;
use Validator;
use Auth;
use App\Rules\ExcelRule;
use App\Imports\EmployeeImport;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees = Employee::has('employees')->get();
        return Redirect::to('/employees');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected $employee, $user;
    public function __construct(){
        $this->employee = new employee();
        $this->user = new User();

    }

    public function store(Request $request)
    { 
        $this->validate($request, ['image' => 'mimes:jpeg,png,jpg,gif,svg']);

        $user = new User([
            'name' => $request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->password),
            'roles' => $request->roles,
        ]);
        $user->save();
        //dd($user);

    //data to dbase
        $employee  = new Employee;
        $employee->user_id  = $user->id;
        $employee->title = $request->title;
        $employee->fname = $request->fname;
        $employee->lname = $request->lname;
        $employee->addressline = $request->addressline;
        $employee->town = $request->town;
        $employee->zipcode = $request->zipcode;
        $employee->phone = $request->phone;
        $employee->role = $request->job;

    //for the image
        if($file = $request->hasFile('image')){
          $file = $request->file('image');
          $fileName = $file->getClientOriginalName();
          $destinationPath = public_path().'/images' ;
          $employee->img_path = 'images/'.$fileName;
          $file->move($destinationPath,$fileName); 
          $employee->save();
        };
          $employee->save();

        return Redirect::to('/employees')->with('success','New Employee Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $employee = Employee::find($id);
        // $employee = Employee::with('user')->where('id',$id)->first();

        $user = User::where('id',$id)->first();
        $user = User::pluck('roles','id');
        $employee = Employee::find($id);

        // $employee = Employee::where('id', $id)->first();
        // $user = User::find($id);

        // $employee = Employee::find($id);
        // $user = User::pluck('id','id')->all();
        // $userRole = $user->roles->pluck('id','id')->all();

        return View::make('employee.edit',compact('employee', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if($file = $request->hasFile('image')){
          $file = $request->file('image');
          $fileName = $file->getClientOriginalName();
          $destinationPath = public_path().'/images' ;
          $employee->img_path = 'images/'.$fileName;
          $file->move($destinationPath,$fileName); 
          $employee->save();
        };

        $employee->save();
        $employee->update($request->all());

        return Redirect::to('/employees')->with('success','Employee Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::where('user_id', $id)->delete();
        User::destroy($id);
        return Redirect::to('/employees')->with('success','Employee deleted!');
    }

    public function getEmployees(EmployeeDataTable $dataTable) {
    
       $employees =  Employee::with([])->get();
        return $dataTable->render('employee.employees');
    }

    public function import(Request $request) {     
        
        Excel::import(new EmployeeImport, request()->file('employee_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }



}
