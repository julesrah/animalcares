@extends('layouts.base')
@include('layouts.app')
@include('layouts.master')
@section('body')
<div class="container">
  <h2>Create New Customer</h2>
  <form method="post" action="{{route('customer.store')}}" enctype="multipart/form-data">
  @csrf
  </div>

   <div class="form-group">
    <label for="title" class="control-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
  </div>

  <div class="form-group"> 
    <label for="lname" class="control-label">Last name</label>
    <input type="text" class="form-control" id="lname" name="lname" value="{{old('lname')}}"> 
  </div> 

  <div class="form-group"> 
    <label for="fname" class="control-label">First Name</label>
    <input type="text" class="form-control" id="fname" name="fname" value="{{old('fname')}}">
  </div>

  <div class="form-group"> 
    <label for="address" class="control-label">Address</label>
    <input type="text" class="form-control" id="address" name="addressline" value="{{old('addressline')}}">
  </div>

  <div class="form-group"> 
    <label for="town" class="control-label">Town</label>
    <input type="text" class="form-control" id="town" name="town" value="{{old('town')}}"> 
  </div>

  <div class="form-group"> 
    <label for="zipcode" class="control-label">Zip code</label>
    <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{old('zipcode')}}">
  </div>

  <div class="form-group"> 
    <label for="phone" class="control-label">Phone</label>
    <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
  </div>

    <div class="form-group"> 
    <label for="phone" class="control-label">Image:</label>
    <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
  </div>
  
<button type="submit" class="btn btn-primary">Save</button>
  <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
  </div>     
</div>
</form> 
@endsection