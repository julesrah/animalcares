@include('layouts.base')
<table class="table table-striped">
    <thead>
      <tr>
        <th>Pet Name</th>
        <th>Pet Status</th>
        <th>Check Up Date</th>
        <th>Disease</th>
        <th>Check Up Cost</th>
        <th>Comments</th>
        </tr> 
    </thead>

    <tbody>
        @foreach($consult as $consult)
        <tr>
        <td>{{$pet->name}}</td>  
        <td>{{$consult->pet_status}}</td>
        <td>{{$consult->checkup_date}}</td>
        <td>{{$consult->disease->disease}}</td>
        <td>{{$consult->checkup_cost}}</td>
        <td>{{$consult->comments}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
