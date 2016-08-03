@extends('layouts.admin')

@section('content')
	<h1>Scores of Users</h1>	
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
                                <td>{{$user->point->rightmoves}}</td>
                                <td>{{$user->point->wrongmoves}}</td>
                            </tr>
                        @endforeach
                    @endif                      
                </tbody>
            </table>
@endsection