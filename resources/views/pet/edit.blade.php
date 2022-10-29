@extends('layouts.base')
@extends('layouts.master')
@extends('layouts.app')
@section('body')
<div class="container" >
<div class="col-md-5 col-md-offset-3">
   <div class="jumbotron jumbotron-fluid" style="background-color: khaki;">
  <h1 style="font-family:Impact;font-size:40px;">EDIT PETS</h1>
{{ Form::model($pets,['method' => 'PUT','route' => ['pets.update',$pets->id],'enctype' =>'multipart/form-data'])}}
  
  <div class="form-group">
    <label for="customer_id" class="control-label">Owner</label>
    {!! Form::select('customer_id', App\Models\Customer::pluck('fname','id'), null,['class' => 'form-control']) !!}
  </div>

  <div class="form-group">
    <label for="name" class="control-label" >Name</label>
    {{ Form::text('name',null,array('class'=>'form-control','id'=>'name')) }}
  </div> 

  <div class="form-group"> 
    <label for="type" class="control-label">Type</label>
    {{ Form::text('type',null,array('class'=>'form-control','id'=>'type')) }} 
  </div> 

  <div class="form-group"> 
    <label for="breed" class="control-label">Breed</label>
    {{ Form::text('breed',null,array('class'=>'form-control','id'=>'breed')) }} 
  </div>

  <div class="form-group">
    <label for="image" class="control-label">Image:</label>
    <input type="file" class="form-control" id="image" name="image" >
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">Save</button>
<a href="{{url()->previous()}}" class="btn btn-default" role="danger">Cancel</a>
  </div>     
</div>
</div>
</div>
{!! Form::close() !!} 
@endsection