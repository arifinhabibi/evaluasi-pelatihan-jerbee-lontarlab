<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // function login
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'message' => 'Invalid error',
                'error' => $validator->errors()
            ], 401);
        }
        
        $credential = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        $user = User::where($credential)->first();

        if (!$user) {
            # code...
            
            return response()->json([
                'message' => 'username or password do not match or empty'
            ], 401);
        }


        $user->update([
            'login_token' => bcrypt($request->username)
        ]);
        
        return response()->json([
            'message' => 'login success',
            'token' => $user->login_token
        ], 200);
    }

    // function logout 
    public function logout(Request $request){
        $user = User::where('login_token', $request->token)->first();
        
        if (!$user) {
            # code...
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        
        $user->update([
            'login_token' => null
        ]);
        
        return response()->json([
            'message' => 'successfully logged out'
        ], 200);
    }
    
    // function me
    public function me(Request $request){
        $user = User::where('login_token', $request->token)->first();
        
        if (!$user) {
         # code...
         return response()->json([
             'message' => 'Unauthorized'
         ], 401);
        }
        
        return response()->json($user, 200);
        
    }
    
    
    
    // function reset password
    public function resetPassword(Request $request){
        $user = User::where('login_token', $request->token)->first();
      
        if (!$user) {
        # code...
        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
        }

        if ($request->old_password != $user->password) {
            # code...
            return response()->json([
                'message' => ' old password did not match'
            ], 422);
        }

        $user->update([
            'password' => $request->new_password
        ]);

        return response()->json([
            'message' => 'reset success, user logged out'
        ], 200);

    }
}
