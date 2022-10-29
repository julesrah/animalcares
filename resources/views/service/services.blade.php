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
<button type="button" class="btn btn-info btn-primary" data-toggle="modal" data-target="#serviceModal">Create New Grooming Service</button>
<button type="button" class="btn btn-info btn-primary" data-toggle="modal" data-target="#emailModal">Contact Us</button>
</div>

<div class="col-xs-6">
   <form method="post" enctype="multipart/form-data" action="{{ url('/service/import') }}">
      @csrf
      <input type="file" id="uploadName" name="service_upload" required>
</div>  
    @error('service_upload')
      <small>{{ $message }}</small>
    @enderror
        <br><br>
         <button type="submit" class="btn btn-info btn-primary">Import Excel File</button>
         </form> 

<div>
    {{-- {{$dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true)}} --}}
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

<div class="modal " id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
        <div class="modal-header text-center">
          <p class="modal-title w-100 font-weight-bold" style="font-family: Impact; font-size: 15px;">Add New Grooming Service</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="POST" action="{{action('ServicesController@store')}}" enctype="multipart/form-data">        
        {{csrf_field()}}
        

      <div class="modal-body mx-3" id="inputfacultyModal" style="font-family: Impact; font-size: 15px;">
        <div class="md-form mb-5" >
        <div class="form-group">
      <i class="fas fa-user prefix grey-text"></i>
          <label for="description" class="control-label">Description</label>
          <input type="text" class="form-control" id="description" name="description" value="{{old('description')}}" style="font-family: Impact; font-size: 15px;">
        </div>
      </div>

        <div class="md-form mb-5" >
        <div class="form-group"> 
<i class="fas fa-user prefix grey-text"></i>
          <label for="price" class="control-label">Price</label>
          <input type="text" class="form-control" id="price" name="price" value="{{old('price')}}" style="font-family: Impact; font-size: 15px;"> 
        </div>
      </div>

        <div class="md-form mb-5">
        <div class="form-group"> 
<i class="fas fa-user prefix grey-text"></i>
           <label for="image" class="control-label">Image:</label>
           <input type="file" name="groomimage[]" placeholder="Choose files" multiple>
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