<!DOCTYPE html>
<html>


	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<head>
    <title>ANIMALCARE RECEIPT</title>
</head>
<body>
	<header>
    <h1>{{ $title }}</h1>
   		<p>Customer Name: {{Auth::user()->customer->lname}}, {{Auth::user()->customer->fname}}</p>
    	<p>Date and Time of Purchase: {{ $date }}</p>
    </header>

    <table class="table table-warning table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">Service Description</th>
      <th scope="col">Service Price</th>
    </tr>
  </thead>
  <tbody>
  		@foreach($orders as $order)
  		<tr>
	      <td>{{$order->id}}</td>
	      <td>{{$order->description}}</td>
	      <td>{{$order->price}}</td>
	      
	    </tr>
  		@endforeach

  </tbody>
</table>
  		<b><p style="text-align:right">TOTAL AMOUNT: {{$total}}</p>





    <footer>
 	 	<p>ANIMAL CARE CLINIC</p>
 	 	<p>Established 2022</p>
	</footer>

</body>
</html>