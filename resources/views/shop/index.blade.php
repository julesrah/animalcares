@extends('layouts.base')
@extends('layouts.app')
@section('content')
   @foreach ($services->chunk(4) as $serviceChunk)

        <div class="row">
            @foreach ($serviceChunk as $service)
               <div class="col-sm-1 col-md-3" style='font-family:Impact; font-size: 20px;text-align: center;'>
                  <div class="thumbnail" style="background-color: khaki;border:10px solid black; border-radius: 5%;">

                <div id="demo{{$service->id}}" class="carousel slide carousel-fade carousel-dark" data-mdb-ride="carousel">
                  <div class="carousel-inner rounded-5 shadow-4-strong">
                    <?php $images = explode("|",$service->img_path); ?>
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
                  
                  <button class="carousel-control-prev" type="button" data-bs-target="#demo{{$service->id}}" data-bs-slide="prev">
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#demo{{$service->id}}" data-bs-slide="next">
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
                
                    <div class="caption">
                           <h2>{{ $service->description }}<span>: ${{ $service->price }}</span></h2>
                      <div class="clearfix">
                           <a href="{{ route('service.addToCart', ['id'=>$service->id]) }}" class="btn btn-primary" style='font-family:Impact; font-size: 15px'  role="button"><i class="fas fa-cart-plus"></i> Add to Cart</a> 
                      </div>
                    </div>
                   </div>
                </div>
                  @endforeach
              </div>
              </div>
        </div>
    @endforeach
@endsection