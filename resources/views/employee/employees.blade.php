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
<button type="button" class="btn btn-info btn-primary" data-toggle="modal" data-target="#artistModal">Create New Employee</button>
<button type="button" class="btn btn-info btn-primary" data-toggle="modal" data-target="#emailModal">Contact Us</button>
</div>

<div class="col-xs-6">
   <form method="post" enctype="multipart/form-data" action="{{ url('/employee/import') }}">
      @csrf
      <input type="file" id="uploadName" name="employee_upload" required>
</div>  
    @error('employee_upload')
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
          <p class="modal-title w-100 font-weight-bold" style="font-family: Impact; font-size: 20px;">Add New Employee</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
          </button>
        </div>
         <form  method="POST" action="{{action('EmployeeController@store')}}" enctype="multipart/form-data">        
        {{csrf_field()}}
          
        <div class="modal-body mx-3" id="inputfacultyModal" style="font-family: Impact; font-size: 15px;">
          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Title</label>
            <input type="text" class="form-control validate" id="title" name="title" style="font-family: impact; font-size: 15px;">
          </div>

          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">First Name</label>
            <input type="text" class="form-control validate" id="fname" name="fname" style="font-family: impact; font-size: 15px;">
          </div>

          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Last Name</label>
            <input type="text" class="form-control validate" id="lname" name="lname" style="font-family: impact; font-size: 15px;">
          </div>

          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Addressline</label>
            <input type="text" class="form-control validate" id="addressline" name="addressline" style="font-family: impact; font-size: 15px;">
          </div>

          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Town</label>
            <input type="text" class="form-control validate" id="town" name="town" style="font-family: impact; font-size: 15px;">
          </div>

          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Zipcode</label>
            <input type="text" class="form-control validate" id="zipcode" name="zipcode" style="font-family: impact; font-size: 15px;">
          </div>

          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Phone</label>
            <input type="text" class="form-control validate" id="phone" name="phone" style="font-family: impact; font-size: 15px;">
          </div>

      <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
    <label for="job" class="form-label">Job</label>
    <select data-error="wrong" data-success="right" class="form-control" id="job" name="job" style="font-family: impact; font-size: 15px;"> 
        <option value="Doctor">Doctor</option>
        <option value="Groomer">Groomer</option>
        <option value="Assistant">Assistant</option>
        <option value="Driver">Driver</option>
        <option value="Security Guard">Security Guard</option>
    </select>
  </div>


          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Email</label>
            <input type="text" class="form-control validate" id="email" name="email" style="font-family: impact; font-size: 15px;">
          </div>

          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Password</label>
            <input type="password" class="form-control validate" id="password" name="password" style="font-family: impact; font-size: 15px;">
          </div>

          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label for="image" class="control-label">Image:</label>
            <input type="file" class="form-control" id="image" name="image" style="font-family: impact; font-size: 15px;" >
               @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          </div>

          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text" hidden=""></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; " hidden="">Roles</label>
            <input type="text" class="form-control validate" id="roles" name="roles" value="Employee" readonly style="font-family: impact; font-size: 15px;" hidden="">
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