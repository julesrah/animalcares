@extends('layouts.base')
{{-- @extends('layouts.master') --}}
@extends('layouts.app')
@section('content')
<div class="container">
<ul class="errors">
 @foreach($errors->all() as $message)
   <li><p>{{ $message }}</p></li>
 @endforeach
 </ul>
  {{-- <h2>Create new Customer</h2>
  <form method="post" action="{{route('customer.store')}}" >
  @csrf --}}
  <div class="col-md-4 col-md-offset-4">
   <div class="jumbotron jumbotron-fluid" style="background-color: khaki;">

   <form method="post" action="{{route('pets.store')}}" enctype="multipart/form-data" >
  @csrf
  <h1 style="font-family:Impact;font-size:50px; color: black">CREATE PET</h1>

{{--   <div class="form-group">
      <label for="customer_id">Owner:</label>
      <select class="form-control" id="customer_id" name="customer_id">
        @foreach($customers as $id => $customer)
          <option value="{{$id}}"><a> {{$customer}} </a></option>
        @endforeach
      </select>
  </div> --}}


{{-- <div class="md-form mb-5" > 
    <div class="form-group">
<i class="fas fa-user prefix grey-text"></i>
            <label for="customer_id" style="font-family: Impact; font-size: 15px;">Your ID:</label>
              {!! Form::text('customer_id', $value = Auth::user()->id, ['readonly'],['class'=>'form-control']) !!}
    </div>
  </div>
 --}}

<div class="form-group"> 
    <label for="customer_id" class="control-label">Owner ID:</label>
    {!! Form::text('customer_id', $value = Auth::user()->customer->id, ['readonly'],['class'=>'form-control']) !!}
    </text>@if($errors->has('customer_id'))
    <small>{{ $errors->first('customer_id') }}</small>
   @endif 
  </div> 

<div class="form-group"> 
    <label for="name" class="control-label">Name:</label>
    <input type="text" class="form-control " id="name" name="name" placeholder="<name>" value="{{old('name')}}">
    </text>@if($errors->has('name'))
    <small>{{ $errors->first('name') }}</small>
   @endif 
  </div> 

  <div class="form-group"> 
    <label for="type" class="control-label">Type:</label>
    <input type="text" class="form-control " id="type" name="type" placeholder="<ex:Dog>" value="{{old('type')}}">
    @if($errors->has('type'))
    <small>{{ $errors->first('type') }}</small>
   @endif 
  </div>

<div class="form-group"> 
    <label for="breed" class="control-label">Breed:</label>
    <input type="text" class="form-control" id="breed" name="breed" placeholder="<ex:Poodle>" value="{{old('addressline')}}">
    @if($errors->has('breed'))
    <small>{{ $errors->first('breed') }}</small>
   @endif 
  </div>

 {{--  <div class="form-group">
        <label>DROPBOX</label> 
        <select name="box" class="form-control">
         @foreach($customers as $customer)
        <option value="{{ $customer->id }}">{{ $customer->type}}</option> 
         @endforeach
        </select>
  </div> --}}

  <div class="form-group">
    <label for="image" class="control-label">Image:</label>
    <input type="file" class="form-control" id="image" name="image" >
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  
<button type="submit" class="btn btn-primary">Save</button>
  <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
  </div>     
</div>
</div>
</div>



</form> 
@endsection