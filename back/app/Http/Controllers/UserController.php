<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
use App\Http\resources\UserResource;

class UserController extends Controller
{
    // Validação usando Form request (recomendado)
     public function createUser(UserRequest $request) {
        $user = new User;
        $user->name = $request->name;
        $user->birth_date = $request->birth_date;
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->is_admin = $request->is_admin;
        $user->save();
        
        return response()->json(UserResource::collection(User::all()));
    }

    // Validação usando Validator
    /*public function createUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'birth_date' => 'required|string',
            'phone_number' => 'string',
            'gender' => 'required|string|max:1',
            'email' => 'required|email|unique:Users,email',
            'password' => 'required',
            'is_admin' => 'required|boolean|digits:1'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $user = new User;
        $user->name = $request->name;
        $user->birth_date = $request->birth_date;
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->is_admin = $request->is_admin;
        $user->save();
        
        return response()->json(['success' => $user]);
    }*/

    public function updateUser(int $user_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'phone_number' => 'string',
            'gender' => 'string|max:1',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::Find($user_id);
        
        if($user == null)
            return response()->json(['error' => 'Usuário não encontrado']);

        if($request->name)
            $user->name = $request->name;
        if($request->phone_number)
            $user->phone_number = $request->phone_number;
        if($request->gender)
            $user->gender = $request->gender;

        $user->save();

        return response()->json(['success' => $user]);
    }
}

