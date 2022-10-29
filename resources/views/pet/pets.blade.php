@extends('layouts.base')
@include('layouts.app')
@include('layouts.master')
@section('body')
  <div class="container">
    <br />
    @if ( Session::has('success'))
      <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div><br/>
     @endif
  </div>

<div>
<button type="button" class="btn btn-info btn-primary" data-toggle="modal" data-target="#artistModal">Create New Pet</button>
<button type="button" class="btn btn-info btn-primary" data-toggle="modal" data-target="#emailModal">Contact Us</button>
</div>

<div class="col-xs-6">
   <form method="post" enctype="multipart/form-data" action="{{ url('/pet/import') }}">
      @csrf
      <input type="file" id="uploadName" name="pet_upload" required>
</div>  
    @error('pet_upload')
      <small>{{ $message }}</small>
    @enderror
        <br><br>
         <button type="submit" class="btn btn-info btn-primary">Import Excel File</button>
         </form> 

<div>
    {{$dataTable->table(['class' => 'table table-bordered table-striped table-dark table-hover'], true)}}
    
  <div class="modal" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="myemailLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
        <div class="modal-header text-center">
          <p class="modal-title w-100 font-weight-bold">Contact Us</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
<form  method="POST" action="{{url('contact')}}">
        {{csrf_field()}}   
        <div class="modal-body mx-3" id="mailModal">
          <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block; 
          width: 150px; ">Send Email</label>
<input type="text" id="sender" class="form-control validate" name="sender" placeholder="your name">
            <input type="text" id="title" class="form-control validate" name="title" placeholder="title">
            <textarea class="form-control validate" name="body" placeholder="Your message"></textarea>
          </div>
        </div>
          <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Send </button>
            <button class="btn btn-success">Cancel</button>
          </div>
 </form>
      </div>
    </div> 
   </div>
</div>

</div>

<div class="modal " id="artistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
        <div class="modal-header text-center">
          <p class="modal-title w-100 font-weight-bold" style="font-family: Impact; font-size: 15px;">Add New Pet</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="POST" action="{{action('PetsController@store')}}" enctype="multipart/form-data">        
        {{csrf_field()}}

      <div class="modal-body mx-3" id="inputfacultyModal" style="font-family: Impact; font-size: 15px;">
        <div class="md-form mb-5" > 
        <div class="form-group">
<i class="fas fa-user prefix grey-text"></i>
            <label for="customer_id" style="font-family: Impact; font-size: 15px;">Owner Name:</label>
              {!! Form::select ('customer_id', App\Models\Customer::pluck('fname','id'), null,['class style="font-family: Impact; font-size: 15px;"' => 'form-control']) !!}
        </div>
      </div>

        <div class="md-form mb-5" >
        <div class="form-group">
<i class="fas fa-user prefix grey-text"></i>
          <label for="name" class="control-label">Pet Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" style="font-family: Impact; font-size: 15px;">
        </div>
      </div>

        <div class="md-form mb-5" >
        <div class="form-group"> 
<i class="fas fa-user prefix grey-text"></i>
          <label for="type" class="control-label">Pet Type</label>
          <input type="text" class="form-control" id="type" name="type" value="{{old('type')}}" style="font-family: Impact; font-size: 15px;" >  
        </div>
      </div>

        <div class="md-form mb-5" >
        <div class="form-group"> 
<i class="fas fa-user prefix grey-text"></i>
          <label for="breed" class="control-label">Pet Breed</label>
          <input type="text" class="form-control" id="breed" name="breed" value="{{old('breed')}}" style="font-family: Impact; font-size: 15px;"> 
        </div>
      </div>

        <div class="md-form mb-5">
        <div class="form-group"> 
<i class="fas fa-user prefix grey-text"></i>
           <label for="image" class="control-label">Image:</label>
           <input type="file" class="form-control" id="image" name="image" style="font-family: Impact; font-size: 15px;" >
               @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
              @enderror
        </div>
      </div>

 <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success" style="font-family: Impact; font-size: 15px;">Save</button>
            <button class="btn btn-danger" data-dismiss="modal" style="font-family: Impact; font-size: 15px;">Cancel</button>
          </div>
        </form>
</div>
</div> 
</div>
@push('scripts')
    {{$dataTable->scripts()}}
  @endpush
@endsection