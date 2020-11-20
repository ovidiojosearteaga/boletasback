<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $userData = $request->all();

        $validator = Validator::make($userData, [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails())
            return $this->sendError('Validation Error.', $validator->errors());

        $userData['password'] = bcrypt($userData['password']);

        $user = User::Create($userData);

        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['user'] = [
            'id' => $user->id,
            'name' => $user->name,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'role' => $user->role
        ];

        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request)
    {
        $userData = ['email' => $request->email, 'password' => $request->password];
        $loginSuccessfully = Auth::attempt($userData);

        if ($loginSuccessfully) {
            $user = Auth::user();

            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['user'] = [
                'id' => $user->id,
                'name' => $user->name,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'role' => $user->role
            ];

            return $this->sendResponse($success, 'User login successfully.');
        
        } else {
            return $this->sendError("Unauthorized.", ['error' => 'Unauthorized']);
        }
    }

    public function logout() 
    {
        if (Auth::check())
            Auth::user()->token()->revoke();

        return $this->sendResponse('Logout', 'User logout successfully.');
    }
}
