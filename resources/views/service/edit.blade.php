@extends('layouts.base')
@extends('layouts.master')
@extends('layouts.app')
@section('body')
<div class="container" >
<div class="col-md-5 col-md-offset-3">
   <div class="jumbotron jumbotron-fluid" style="background-color: khaki;">
  <h1 style="font-family:Impact;font-size:40px;">EDIT GROOMING SERVICES</h1>
{{ Form::model($services,['method' => 'PUT','route' => ['services.update',$services->id],'enctype' =>'multipart/form-data'])}}


  <div class="form-group">
    <label for="description" class="control-label" >Description</label>
    {{ Form::text('description',null,array('class'=>'form-control','id'=>'description')) }}
  </div> 

  <div class="form-group"> 
    <label for="price" class="control-label">Price</label>
    {{ Form::text('price',null,array('class'=>'form-control','id'=>'price')) }} 
  </div> 

  <div class="form-group">
    <label for="image" class="control-label">Image:</label>
    <input type="file" class="form-control" id="image" name="image" >
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <button price="submit" class="btn btn-primary">Save</button>
<a href="{{url()->previous()}}" class="btn btn-default" role="danger">Cancel</a>
  </div>     
</div>
</div>
</div>
{!! Form::close() !!} 
@endsection