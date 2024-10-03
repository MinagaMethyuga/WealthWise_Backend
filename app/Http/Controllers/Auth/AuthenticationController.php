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
                'first_name'=>'string|required',
                'last_name'=>'string|required',
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

    public function uploadProfileImage(Request $request)
    {
        // Validate the request
        $request->validate([
            'user_id' => 'required|numeric',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Get the uploaded file
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time().'.'.$image->extension();

            // Save the image to the 'public/profile_images' directory
            $image->move(public_path('profile_images'), $imageName);

            // Find the user and update their profile image path
            $user = User::find($request->user_id);
            if ($user) {
                $user->profile_image = 'profile_images/'.$imageName;
                $user->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Image uploaded successfully',
                    'image_path' => $user->profile_image
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'No image uploaded'
        ], 400);
    }
}
