@extends('layouts.app')
@extends('layouts.base')
{{-- @extends('layouts.master') --}}
@section('content')

<div class="container text-center">
	 <div align="center" >
	  <a href="{{ route('getEmployees') }}" class="btn a-btn-slide-text" >
	 </div>	
	  <br>

 <div class="container" style='font-family:Impact; font-size: 20px; background-image:linear-gradient(to bottom, beige , gold);'>
 <br><br>

<img src="{{ asset($employee->img_path) }}" width="700" height="500" class="rounded" style="border:10px solid black; border-radius: 10%;"  >
 <h1>Name:{{' '}}{{$employee->title}}{{'. '}}{{$employee->fname}}{{' '}}{{$employee->lname}}</h1>
 <h1>Address:{{' '}}{{$employee->addressline}}{{', '}}{{$employee->town}}</h1>
 <h1>Zipcode:{{' '}}{{$employee->zipcode}}</h1>
 <h1>Contact Number:{{' '}}{{$employee->phone}}</h1>
 @endsection
</div>
</div>