<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()
        ->json([
            'data' => $data,
            'user_id' => $data->id,            
            'message' => 'Register success',
        ]);

    }

    public function login(Request $request) {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response() -> json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('nobiTest')->plainTextToken;

        return response()
        ->json([
            'message' => 'Hi, '.$user->name,
            'token' => $token,
        ]);
    }
}
