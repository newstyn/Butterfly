
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">  
                
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
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
