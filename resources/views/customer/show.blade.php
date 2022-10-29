@extends('layouts.app')
@extends('layouts.base')
{{-- @extends('layouts.master') --}}
@section('content')

<div class="container text-center"  >
	 <div align="center" >
	  <a href="{{ route('getCustomers') }}" class="btn a-btn-slide-text" >
	 </div>	
	  <br>

 <div class="container" style='font-family:Impact; font-size: 20px; background-image:linear-gradient(to bottom, beige , gold);'>
 <br><br>

<img src="{{ asset($customer->img_path) }}" width="700" height="500" class="rounded" style="border:20px solid black; border-radius: 10%;"  >
 <h1>Name:{{' '}}{{$customer->title}}{{'. '}}{{$customer->fname}}{{' '}}{{$customer->lname}} </h1>
 <h1>Address:{{' '}}{{$customer->addressline}}{{', '}}{{$customer->town}}</h1>
 <h1>Zipcode:{{' '}}{{$customer->zipcode}}</h1>
 <h1>Contact Number:{{' '}}{{$customer->phone}}</h1>
 @endsection

</div>
</div>