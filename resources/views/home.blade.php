@extends('layouts.app')
@extends('layouts.base')
@include('layouts.master')

@section('content')
  {{--   <div class="row">
        <div class="col-md-4 col-md-offset-4"> --}}

    @if ( Session::has('success'))
      <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div><br/>
    @endif

      <div class="container text-center">
       {{--  <div align="center" >
             <a href="{{route('customer.edit', Auth::user()->customer->id)}}" class="btn a-btn-slide-text" >
        </div>   --}}
      <br>

     <div class="container" style='font-family:Impact; font-size: 20px; background-image:linear-gradient(to bottom, beige , gold);'>
     <br><br>
      
            @if(Auth::user()->roles=='Customer')

            <a  href="{{route('pets.create', Auth::user()->customer->id)}}" style='font-family:Impact; font-size: 20px;' class="av-link btn btn-success btn-lg"> <i class="fa-solid fa-paw"></i>Add Pet</a>
            <a  href="{{route('customer.edit', Auth::user()->customer->id)}}" style='font-family:Impact; font-size: 20px;' class="av-link btn btn-danger btn-lg"> <i class="fa-solid fa-pen-to-square"></i>Edit</a>

            <h1>Welcome to Animal Care, {{ Auth::user()->customer->fname}} {{ Auth::user()->customer->lname}}</h1>
            <img src="{{ asset(Auth::user()->customer->img_path) }}" width="700" height="500" class="rounded" style="border:20px solid black; border-radius: 10%;">
            <h1>Address: {{ Auth::user()->customer->addressline}}{{', '}}{{ Auth::user()->customer->town}}<h1>
            <h1>Zipcode: {{ Auth::user()->customer->zipcode}}</h1>
            <h1>Email: {{ Auth::user()->email}}</h1> 
 
            @elseif(Auth::user()->roles=='Employee')
            <h1>Welcome, {{ Auth::user()->employee->fname}} {{ Auth::user()->employee->lname}}</h1>
            <img src="{{ asset(Auth::user()->employee->img_path) }}" width="700" height="500" class="rounded" style="border:20px solid black; border-radius: 10%;">
            <h1>Address: {{ Auth::user()->employee->addressline}}{{', '}}{{ Auth::user()->employee->town}}<h1>
                 <h1>Zipcode: {{ Auth::user()->employee->zipcode}}</h1>
            <h1>Email: {{ Auth::user()->email}}</h1> 

            @elseif(Auth::user()->roles=='Administrator')
            <h1>Welcome, Administrator {{ Auth::user()->employee->fname}} {{ Auth::user()->employee->lname}}</h1>
            <img src="{{ asset(Auth::user()->employee->img_path) }}" width="700" height="500" class="rounded" style="border:20px solid black; border-radius: 10%;">
            <h1>Address: {{ Auth::user()->employee->addressline}}{{', '}}{{ Auth::user()->employee->town}}<h1>
                 <h1>Zipcode: {{ Auth::user()->employee->zipcode}}</h1>
            <h1>Email: {{ Auth::user()->email}}</h1> 


            @endif

         </a> 
         
     </div>

@endsection













{{-- <img src="{{ asset($customer->img_path) }}" width="700" height="500" class="rounded" style="border:20px solid black; border-radius: 10%;"  >
 <h1>Name:{{' '}}{{$customer->title}}{{'. '}}{{$customer->fname}}{{' '}}{{$customer->lname}} </h1>
 <h1>Address:{{' '}}{{$customer->addressline}}{{', '}}{{$customer->town}}</h1>
 <h1>Zipcode:{{' '}}{{$customer->zipcode}}</h1>
 <h1>Contact Number:{{' '}}{{$customer->phone}}</h1>
 @endsection --}}