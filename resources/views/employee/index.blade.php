@extends('layouts.base')
@section('body')
  <div class="container">
       <a href="{{route('employee.create')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><strong>ADD</strong></span>            
    </a>
  </div>
@if ($message = Session::get('success'))
 <div class="alert alert-success alert-block">
 <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ $message }}</strong>
 </div>
@endif
<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Employee ID</th>
        <th>Title</th>
        <th>Lname</th>
        <th>Fname</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Restore</th>
        <th>Show</th>
        </tr>
    </thead>
<tbody>
      @foreach($employees as $employee)
      <tr>
        <td>{{$employee->id}}</td>
        <td>{{$employee->title}}</td>
        <td>{{$employee->fname}}</td>
        <td>{{$employee->addressline}}</td>
        <td>{{$employee->phone}}</td>
         
 @if($employee->deleted_at)
        <td align="center"><a href="#"><i class="fa-regular fa-pen-to-square" style="font-size:24px; color:gray" ></a></i>
</td>
</td>
    @else 

        <td align="center"><a href="{{ route('employee.edit',$employee->id) }}"><i class="fa-regular fa-pen-to-square" aria-hidden="true" style="font-size:24px" ></a></i></td>
    @endif

       <td align="center">{!! Form::open(array('route' => array('employee.destroy', $employee->id),'method'=>'DELETE')) !!}
        <button ><i class="fa-solid fa-trash-can" style="font-size:24px; color:red" ></i></button>
        {!! Form::close() !!}
        </td>
        
       @if($employee->deleted_at)
          <td align="center"><a href="{{ route('employee.restore',$employee->id) }}" ><i class="fa fa-undo" style="font-size:24px; color:red" disabled="true"></i></a>
        </td>
        @else
        <td align="center"><a href="#" ><i class="fa fa-undo" style="font-size:24px; color:gray" ></i></a>
        </td>
        @endif

         @if($employee->deleted_at)
        <td align="center"><a href="#"><i class="fa-solid fa-eye" style="font-size:24px; color:gray" ></a></i>
</td>
</td>
    @else 
        <td align="center"><a href="{{ route('employee.show',$employee->id) }}"><i class="fa-solid fa-eye" aria-hidden="true" style="font-size:24px" ></a></i>
        </td>

        @endif
        </tr>
      @endforeach


</table>
{{-- <div>
    {{$employees->links()}}</div> --}}
</div>
</div>
@endsection