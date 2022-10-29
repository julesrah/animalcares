<?php

namespace App\Http\Controllers;

Use App\Models\Employee;
Use App\Models\Pets;
Use App\Models\Customer;
Use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
Use App\DataTables\CustomersDataTable;
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
use App\Imports\CustomerImport;



class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $customers = Customer::has('customers')->get();
        return Redirect::to('/customers');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    protected $customer, $user;
    public function __construct(){
        $this->customer = new Customer();
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

        $customer  = new Customer;
        $customer->user_id  = $user->id;
        $customer->title = $request->title;
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->addressline = $request->addressline;
        $customer->town = $request->town;
        $customer->zipcode = $request->zipcode;
        $customer->phone = $request->phone;

        if($file = $request->hasFile('image')){
          $file = $request->file('image');
          $fileName = $file->getClientOriginalName();
          $destinationPath = public_path().'/images' ;
          $customer->img_path = 'images/'.$fileName;
          $file->move($destinationPath,$fileName); 
          $customer->save();
        };
        $customer->save();

        return Redirect::to('/customers')->with('success','New Customer Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('customer.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::find($id);
        return View::make('customer.edit',compact('customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if($file = $request->hasFile('image')){
          $file = $request->file('image');
          $fileName = $file->getClientOriginalName();
          $destinationPath = public_path().'/images' ;
          $customer->img_path = 'images/'.$fileName;
          $file->move($destinationPath,$fileName); 
          $customer->save();
        };
        $customer->save();
        $customer->update($request->all());
        return Redirect::to('/home')->with('success','Customer Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $customers = Customer::with('user')->find($id);
        $customers->user()->delete();
        $customers = Customer::find($id);
        $customers->delete();

        return Redirect::to('/customers')->with('success','Customer deactivated!');
    }

    public function restore($id)
    {   
        $customers =  Customer::withTrashed('user')->find($id);
        $customers->user()->restore();

        $customers = Customer::withTrashed()->find($id);
        $customers->restore();

        return Redirect::to('/customers')->with('success','Customer Activated!');
    }

    public function getCustomers(CustomersDataTable $dataTable) {
    
       $customers =  Customer::with(['pets'])->get();
        return $dataTable->render('customer.customers');
    }


    // public function getCustomers(CustomersDataTable $dataTable){
    //   $customers = Customer::orderBy('fname', 'DESC')->get();

    //     return $dataTable->render('customer.customers');

    //    }

    public function import(Request $request) {     
  
        Excel::import(new CustomerImport, request()->file('customer_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }

}