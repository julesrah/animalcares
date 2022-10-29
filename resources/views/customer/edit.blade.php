@extends('layouts.base')
@extends('layouts.master')
@extends('layouts.app')
@section('body')
<div class="container" >
<div class="col-md-5 col-md-offset-3">
   <div class="jumbotron jumbotron-fluid" style="background-color: khaki;" >
  <h1 style="font-family:Impact;font-size:40px;">EDIT CUSTOMER</h1>
{{ Form::model($customers,['method' => 'PUT','route' => ['customer.update',$customers->id],'enctype' =>'multipart/form-data']) }}

  <div class="form-group">
    <label for="title" class="control-label" >Title</label>
    {{ Form::text('title',null,array('class'=>'form-control','id'=>'title')) }}
  </div> 

  <div class="form-group"> 
    <label for="lname" class="control-label">Last name</label>
    {{ Form::text('lname',null,array('class'=>'form-control','id'=>'lname')) }} 
  </div> 

  <div class="form-group"> 
    <label for="fname" class="control-label">First Name</label>
    {{ Form::text('fname',null,array('class'=>'form-control','id'=>'fname')) }} 
  </div>

  <div class="form-group"> 
    <label for="address" class="control-label">Address</label>
    {{ Form::text('addressline',null,array('class'=>'form-control','id'=>'addressline')) }}
  </div>

  <div class="form-group"> 
    <label for="town" class="control-label">Town</label>
    {{ Form::text('town',null,array('class'=>'form-control','id'=>'town')) }}
  </div>

  <div class="form-group"> 
    <label for="zipcode" class="control-label">Zip code</label>
    {{ Form::text('zipcode',null,array('class'=>'form-control','id'=>'zipcode')) }}
  </div>

  <div class="form-group"> 
    <label for="phone" class="control-label">Phone</label>
    {{ Form::text('phone',null,array('class'=>'form-control','id'=>'phone')) }} 
  </div>

  <div class="form-group"> 
    <label for="img_path" class="control-label">Images</label>
        <input type="file" class="form-control" id="image" name="image" >
  </div>

  <button type="submit" class="btn btn-primary">Save</button>
<a href="{{url()->previous()}}" class="btn btn-danger" role="button">Cancel</a>
  </div>     
</div>
</div>
</div>
{!! Form::close() !!} 
@endsection