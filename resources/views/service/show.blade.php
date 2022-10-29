@extends('layouts.app')
@extends('layouts.base')
{{-- @extends('layouts.master') --}}
@section('content')

<div class="container text-center"  >
	 <div align="center" >
	  <a href="{{ route('getServices') }}" class="btn a-btn-slide-text" >
	 </div>	
	  <br>

 <div class="container" style='font-family:Impact; font-size: 20px; background-image:linear-gradient(to bottom, beige , gold);'>
 <br><br>

{{-- <img src="{{ asset($services->img_path) }}" width="700" height="500" class="rounded" style="border:10px solid black; border-radius: 10%;"  > --}}
<div id="demo{{$services->id}}" class="carousel slide carousel-fade carousel-dark" data-mdb-ride="carousel">
                  <div class="carousel-inner rounded-5 shadow-4-strong">
                    <?php $images = explode("|",$services->img_path); ?>
                    @if(count($images) > 1)
                        @foreach($images as $key => $item)
                            @if($key == 0 )
                            <div class="carousel-item active">
                              <img src="{{url($item)}}" class="d-block w-100" height="250" width="250">
                            </div>
                            @else
                            <div class="carousel-item">
                              <img src="{{url($item)}}" class="d-block w-100" height="250" width="250">
                            </div>
                            @endif
                        @endforeach
                    @else
                        <div class="carousel-item active">
                          <img src="{{url($images[0])}}" height="150" width="150" class="img-responsive">
                        </div>
                    @endif
                  </div>
</div>

 <h1>Description:{{' '}}{{$services->description}}</h1>
 <h1>Price:{{' '}}{{$services->price}}</h1>
 @endsection

</div>
</div>