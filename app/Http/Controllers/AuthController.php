<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->only('name', 'email', 'password', 'password_confirmation'), [
            'name' => ['required', 'min:2', 'max:50', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'max:255', 'confirmed', 'string'],
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);
        $input = $request->only('name', 'email', 'password');
        $input['password'] = Hash::make($request['password']);
        $user = User::create($input);

        $this->createWallet($user);

        $data =  [
            'token' => $user->createToken('Sanctom')->plainTextToken,
            'user' => $user,
        ];
        return response()->json($data, 200);
    }




    public function login(Request $request)
    {
        $validator = Validator::make($request->only('email', 'password'), [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'min:6', 'max:255', 'string'],
        ]);


        if ($validator->fails())
            return response()->json($validator->errors(), 400);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $request->user();
            $data =  [
                'token' => $user->createToken('Sanctom')->plainTextToken,
                'user' => $user,
            ];
            return response()->json($data, 200);
        }
        return response([
            'message' => ['These credentials do not match our records.']
        ], 404);
    }




    public function logout(Request $request)
    {

        // dd(auth()->user);

        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'logged out'
        ]);
    }



    public function createWallet(User $user){

        // dd($user->id);

        do {
            // get a random 12 digit number
            $Rib = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
            // check if it is unique
            $exists = Wallet::where('Rib', $Rib)->exists();
        } while ($exists);

        // dd($Rib);
        
        // return $identifier

        Wallet::create([
            'Balance' => 0,
            'Rib' => $Rib,
            'user_id' => $user->id,
        ]);
    }
}

    // public function logout(Request $request)
    // {
    //     if (Auth::user()) {
    //         $request->user()->token($request['token'])->revoke();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Logged out successfully',
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Logged out failed',
    //         ], 401);
    //     }
    // }
