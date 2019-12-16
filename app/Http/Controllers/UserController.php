<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use App\Http\Requests\ValidationUser;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
  public $successStatus = 200;


    public function login(Request $request){  

        //    $user= User::where('email',$request['email'])->get();

        // if(User::where('email',$request['email'])->get()){ 
        //     Log:info($user[0]->password);

        //   if($user[0]->password==$request['password']){
          $credentials = array('email' => request('email'), 'password' => request('password'));

          if(Auth::attempt($credentials, true)){
            Log:info($credentials);

            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['user'] = $user;
            return response()->json(['success' => $success], 200); 
          }
        else{
            return response()->json(['error'=>'NV'], 401); 

        }
    }
            public function register(Request $request) {
              $request['password'] = bcrypt($request['password']); 

                 $user = User::create([
                    "name"=>$request["name"],
                    "password"=>$request["password"],

                    "email"=>$request["email"],

                 ]); 
                 $success['token'] =  $user->createToken('miraptek.kz')-> accessToken; 
                    $success['user'] =  $user; 
                    return response()->json(['success'=>$success], $this-> successStatus); 
            }
            public function show(Request $request) {
            }

}
