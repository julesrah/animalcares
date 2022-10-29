@extends('layouts.master')
@include('layouts.app')
@include('layouts.base')
@section('content')

<style>
    .column {
  float: left;
  width: 20%;
  margin-bottom: 16px;
  padding: 0 8px;
}
</style>

{{-- <div style="background-color: #4BE1DB;"> --}}
<div class="col-md-8 col-md-offset-0">
<div class="jumbotron jumbotron-fluid" style="background-color: khaki; border:10px solid black; border-radius: 10%;" >
<div class="container">
   
        <div class="text-center" >
            {{-- <td><img src="{{asset($services->img_path)}}" style="width:500px;height:300px;border:5px solid black; border-radius: 10%;"/></td> --}}

            <div id="demo{{$services->id}}" class="carousel slide carousel-fade carousel-dark" data-mdb-ride="carousel">
                  <div class="carousel-inner rounded-5 shadow-4-strong">
                    <?php $images = explode("|",$services->img_path); ?>
                    @if(count($images) > 1)
                        @foreach($images as $key => $item)
                            @if($key == 0 )
                            <div class="carousel-item active">
                              <img src="{{url($item)}}" class="d-block w-100" height="400" width="400">
                            </div>
                            @else
                            <div class="carousel-item">
                              <img src="{{url($item)}}" class="d-block w-100" height="400" width="400">
                            </div>
                            @endif
                        @endforeach
                    @else
                        <div class="carousel-item active">
                          <img src="{{url($images[0])}}" height="150" width="150" class="img-responsive">
                        </div>
                    @endif
                  </div>
                  
                  <button class="carousel-control-prev" type="button" data-bs-target="#demo{{$services->id}}" data-bs-slide="prev">
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#demo{{$services->id}}" data-bs-slide="next">
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>

            <br>
            <h2>Service Description:{{"   "}}{{$services->description}}</h2>
            <h2>Service Price:{{"   "}}{{$services->price}}</h2>
        </div> 
        </div>

     @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
             <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong></div>
     @endif

     <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="card">
        <div class="text-center">
            <div style="background-color: darkkhaki;">
            <div class="container" style='font-family:fantasy ; font-size: 25px;'>
            <div class="card-header">{{ __('SUGGESTIONS/  COMMENTS') }}</div></div></div>
      <form method="post" action="{{route('comment.storeComment',$services->id)}}" 
        enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

         <div class="form-group"> 
                <label for="guests" class="control-label">Name: (optional)</label>
                <input type="text" class="form-control " id="guests" name="guests">
                  
          @if($errors->has('guests'))
                <small>{{ $errors->first('guests') }}</small>
          @endif 
         </div>

          <div class="form-group"> 
                <label for="comments" class="control-label">Leave a comment</label>
                <input type="text" class="form-control " id="comments" name="comments" value="{{old('comments')}}">

            @if($errors->has('comments'))
                  <small>{{ $errors->first('comments') }}</small>
            @endif 
                  </div> 
                 <br>
                <div>
             <button type="submit" class="btn btn-primary">Save</button>
              <a href="{{ route('comment.index') }}" class="btn btn-default" role="button">Cancel</a>
              </div>
               </div> 
               </div>    
            </div>
            <br><br><br><br>
        <br><br><br><br>
          </form> 
            </div>
        </div>
    </div>
  </div>

     <h2>COMMENT HISTORY:</h2>
   @foreach($comments as $comment)
   <div ></div>
                  <hr>                  
                  <h2><i class="fa-solid fa-user-group"></i>{{$comment->guests}}</h2>
                  <h2><i class="fa-solid fa-comment"></i>{{$comment->comments}}</h2>  
     @endforeach
   </div>
</div>
@endsection