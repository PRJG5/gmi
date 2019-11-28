<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Object_;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function updateRole(Request $request){
        if(Auth::user()->id == User::find($request->userId)->id){
            return ["status" => "ERROR", "type" => "Permission non accordée", "message" => "Vous ne pouvez pas modifier vos propres droits" ];
        }else{
            $user = User::find($request->userId);
            $user->role = $request->role;
            $user->save();
            return ["status" => "SUCCESS", "type" => "", "message" => "" ];
        }
    }

}
