@extends('layouts.base')
@include('layouts.app')
@include('layouts.master')
@section('body')
  <div class="container">
    @if ( Session::has('success'))
      <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div>
     @endif
  </div>
<div class="col-xs-6">
   <button type="button" class="btn btn-info btn-primary" data-toggle="modal" data-target="#consultationModal">Add Consultation</button>
 </div>

  <div >
    {{$dataTable->table(['class' => 'table table-bordered table-striped table-dark table-hover'], true)}}
  </div>
<div class="modal " id="consultationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
        <div class="modal-header text-center">
          <p class="modal-title w-100 font-weight-bold" style="font-family: Impact; font-size: 20px;">Add Consultation</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
          </button>
        </div>
 <form  method="POST" enctype="multipart/form-data" action="{{url('consultation')}}">
        {{csrf_field()}}
        
        <div class="modal-body mx-3" id="inputfacultyModal" style="font-family: sans-serif; font-size: 15px;">
          <div class="md-form mb-5">
            <div class="md-form mb-5" style="position: absolute; left: -100rem;">
              {!! Form::text('employee_id',App\Models\Employee::where('role','veterinarian')->orWhere('user_id',Auth::id())->latest()->pluck('id')->first(),['readonly'],null,['class' => 'form-control',],) !!}
                </div>
        </div>

          <div class="md-form mb-5">
            <label for="pet_id">Pet:</label>
              {!! Form::select('pet_id', App\Models\Pets::pluck('name','id'), null,['class' => 'form-control']) !!}
          </div>

          <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Comment</label>
            <input type="text" class="form-control validate" id="comment" name="comment">
          </div>

          <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Price</label>
            <input type="text" class="form-control validate" id="price" name="price">
          </div>
       <div class="form-group">
        <label for="Injury/Disease ">Injury / Disease :</label>
        @foreach($injuries as $injury ) 
           <div class="form-check form-check-inline">
            {{ Form::checkbox('injury_id[]',$injury->id, null, array('class'=>'form-check-input','id'=>'injuries')) }} 
              {!!Form::label('injuries', $injury->description,array('class'=>'form-check-label')) !!}
            </div> 
        @endforeach 
      </div>

 <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Save</button>
            <button class="btn btn-light" data-dismiss="modal">Cancel</button>
          </div>
        </form>
  </div>
    </div>
  </div>
  @push('scripts')
    {{$dataTable->scripts()}}
  @endpush
@endsection