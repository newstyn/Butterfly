<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\User;
use App\Point;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function userExist($userId)
    {
        try
        {
            //Point::findOrFail('user_Id' , '$userId')->orderBy('user_id' , 'desc')->take(1)->get();
            Point::findOrFail('$userId');
        }
        catch(ModelNotFoundException $e)
        {
            return false;
        }
        return true;
    }

    public function index()
    {
        $users = User::all();

        return view('home' , compact('users'));
    }

    
    public function updatePoints(Request $request)
    {
        if( $request->user() ) 
        {
            $user = $request->user();

            if( $this->userExist($user->id) == true )
            {
                $points = Point::find($user->id);

                $wrongmoves = $request->wrongmoves;
                $rightmoves = $request->rightmoves;

                $points->rightmoves = $rightmoves;
                $points->wrongmoves = $wrongmoves;

                $points->save();
            }
            else
            {
                $points = new Point;

                $points->user_id = $user->id;
                
                $wrongmoves = $request->wrongmoves;
                $rightmoves = $request->rightmoves;

                $points->rightmoves = $rightmoves;
                $points->wrongmoves = $wrongmoves;

                $points->save();
            }
            return redirect('\home');
        }
        else
        {
            echo "not found";
        }
        //return view('update');
    }


    public function learn()
    {
        return view('learn');
    }

}
