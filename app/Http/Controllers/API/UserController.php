<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Http\Resources\User as UserResource;

class UserController extends BaseController
{
    public function index() 
    {
        $users = User::all();

        return $this->sendResponse(UserResource::collection($users), 'users retrieved successfully.');
    }

    public function store(Request $request)
    {
        $userData = $request->all();

        $validator = Validator::make($userData, [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails())
            return $this->sendError('Validation Error.', $validator->errors());

        $user = User::create($userData);

        return $this->sendResponse(new UserResource($user), 'users created successfully.');
    }

    public function show($id) 
    {
        $user = User::find($id);

        if (is_null($user))
            $this->sendError('user not found.');

        return $this->sendResponse(new UserResource($user), 'user retrieved successfully.');
    }

    public function update(Request $request, User $user)
    {
        $user->name = isset($request->name) ? $request->name : $user->name;
        $user->lastname = isset($request->lastname) ? $request->lastname : $user->lastname;

        $user->save();

        return $this->sendResponse(new UserResource($user), 'user updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return $this->sendResponse([], 'User delete successfully');
    }
}
