@extends('layouts.base')
{{-- @extends('layouts.master') --}}
@extends('layouts.app')
@section('title')
    Laravel Shopping Cart
@endsection
@section('content')

    @if(Session::has('cart'))
      <div class="jumbotron jumbotron-fluid" style="background-color: khaki;">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group" style="font-size: 22px;">
                    @foreach($services as $service)
                            <li class="list-group-item">
                                <span class="badge">{{ $service['qty'] }}</span>
                                <strong>{{ $service['service']['description'] }}</strong>
                                <span class="label label-success">{{ $service['price'] }}</span>
                                    <a class="av-link btn btn-outline-danger btn-lg"  href="{{ route('service.remove',['id'=>$service['service']['id']]) }}">Remove</a>
                            </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <hr style="height: 20px;">

        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <strong style="font-size: 22px;">Total Amount: {{ $totalPrice }}</strong>
            <br>
            <a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>

            </div>
        </div>
        <hr style="height: 20px;">
      
    @else
        <div class="row">
            <div class="jumbotron jumbotron-fluid" style="background-color: khaki;">
             <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h3 style="text-align: center;">NO SERVICE ADDED IN CART, PLEASE ADD ONE FIRST.</h3>
             </div>
            </div>
        </div>

    @endif
    </div>
@endsection