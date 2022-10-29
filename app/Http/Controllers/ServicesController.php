<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Services;
Use App\Models\Order;
Use App\DataTables\ServiceDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use App\Rules\ExcelRule;
use App\Imports\ServiceImport;
use App\Cart;
use DB;
use Redirect;
use View;
use Excel;
use Validator;
use File;
use Storage;
use Auth;
use Session;
use PDF;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services= Services::get();
        $services = Services::orderBy('id')->paginate(6);
        return view('shop.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $destinationPath = public_path();
        $images=array();
        if($files=$request->file('groomimage')){
            foreach($files as $file){
                $filename=$file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $images[]=$filename;
            }
        }
        
        $allImages = implode("|",$images);

        $service = new Services;
        $service->description = $request->description ;
        $service->price = $request->price ;
        $service->img_path = $allImages;

        $service->save();

        return Redirect::to('/services')->with('success','New Grooming Services Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $services = Services::find($id);
        return view('service.show',compact('services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Services::find($id);
        return View::make('service.edit',compact('services'));
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
        $service = Services::find($id);

        $validator = Validator::make($request->all(), Services::$rulesss);
        
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
                            $input['img_path'] = 'images/'.$fileName;            
                            $service->update($input);
                            $file->move($destinationPath,$fileName);
                            return Redirect::to('/services')->with('success','Grooming service has been updated!');
                        } 
                    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $services= Services::find($id);
        $services->delete();
        return Redirect::to('/services')->with('success','service Deleted!');
    }

    public function getServices(ServiceDataTable $dataTable) 
     {        
        $services = services::with([])->get();
        return $dataTable->render('service.services');
    }

    public function import(Request $request) {     
        
        Excel::import(new ServiceImport, request()->file('service_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }


    public function getAddToCart(Request $request , $id){
        $service = Services::find($id);
        $oldCart = Session::has('cart') ? $request->session()->get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($service, $service->id);
        $request->session()->put('cart', $cart);
        Session::put('cart', $cart);
        $request->session()->save();

        // return redirect()->back()->with('info', 'Service has been added successfully!');
                    return redirect()->back()->with('success','Grooming service has been updated!');

    }

    public function getCart() { 
        // $pets = Pet::select("id", "name")->pluck('name','id');

        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['services' => $cart->services, 'totalPrice' => $cart->totalPrice]);
    }

    public function getSession(){
     Session::flush();
    }

    public function postCheckout(Request $request){

        if(Auth::check()) {

        if (!Session::has('cart')) {
            return redirect()->route('service.shoppingCart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        // dd($cart);
        try {
            DB::beginTransaction();
            $order = new Order();
            $customer =  (Auth::user()->customer->id);
            $order->customer_id = $customer;
            $order->status = 'Unpaid';
            $order->save();

            foreach($cart->services as $services){
            $id = $services['service']['id'];
            $order->services()->attach($id);
            }
        
        $orders = Services::join('orderline', 'orderline.service_id', '=', 'services.id')
        ->join('orderinfo','orderinfo.id','=','orderline.orderinfo_id')
        ->join('customers','customers.id','=','orderinfo.customer_id')
        ->select('services.id', 'services.price', 'services.description')
        ->where('orderinfo.id', '=', $order->id)
        ->get();
        
        $data = [
            'title' => 'Receipt for ANIMALCARE',
            'date' => now(),
            'total' => $cart->totalPrice,
         ];

        $pdf = PDF::loadView('pdf', $data, compact('orders'));

        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->route('service.shoppingCart')->with('error', $e->getMessage());
        }

        DB::commit();

        Session::forget('cart');
          
        return $pdf->download('ANIMALCARE_RECEIPT.pdf');

        } else {
            return Redirect::route('user.signin')->with('warning', 'Please sign-in first.');
        }
    }

    public function getReduceByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
         if (count($cart->service) > 0) {
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }        
        return redirect()->route('service.shoppingCart');

    }

    public function getRemoveItem($id){
        $oldCard = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCard);
        $cart->removeItem($id);
        if (count($cart->services) > 0) {
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
         return redirect()->route('service.shoppingCart')->with('success','Service Removed.');
    }

}