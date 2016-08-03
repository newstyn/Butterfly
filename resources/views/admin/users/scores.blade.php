@extends('layouts.admin')

@section('content')
	<h1>Users</h1>	
  			<table class="table table-striped">
    			<thead>
      				<tr>
				        <th>Name</th>
				        <th>Right Moves</th>
				        <th>Wrong Moves</th>
      				</tr>
    			</thead>

    			<tbody>
    				@if($users)
	    				@foreach($users as $user)
		      				<tr>
						        <td>{{$user->name}}</td>
						        <td>{{$user->pointscount->rightmoves}}</td>
						        <td>{{$user->pointscount->rightmoves}}</td>
		      				</tr>
		      			@endforeach
		      		@endif      				
    			</tbody>
  			</table>
  		</div>
@endsection