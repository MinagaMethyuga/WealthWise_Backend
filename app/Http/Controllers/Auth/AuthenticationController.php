<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function CreatUser(Request $request)
    {
        return rescue(function ()use ($request){
            $request->validate([
                'fname'=>'string|required',
                'lname'=>'string|required',
                'email'=>'email|required|unique:users',
                'password'=>'string|required|min:8',
            ]);
            return response()->json([
                'status'=>'true',
                'payload'=> tap(User::Create($request->all()),
                function ($user){
                 $user->token=$user->createToken('api-token')->plainTextToken;
                })
            ],200);
        },function (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        });
    }
    public function LoginUser(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email',$email)->first();

        if ($user && Hash::check($password, $user->password)){
            return response()->json([
                'message' => 'Login successful', 'user' => $user
            ], 200);
        }else
        {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 500);
        }
    }
    //function to show all the user in the dashboard
    public function showUsers()
    {
        // Fetch all users from the database
        $users = User::all();

        // Return JSON response with users data
        return response()->json([
            'status' => 'true',
            'payload' => $users
        ], 200);
    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
