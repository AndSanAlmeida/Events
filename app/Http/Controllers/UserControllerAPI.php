<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserControllerAPI extends Controller
{
    public function store(Request $request) {
        // Validator
		$validator = Validator::make($request->all(), [
            'first_name' => 'required|max:15',
            'last_name' => 'required|max:15',
			'email' => 'required|email|max:255',
			'password' => 'required|min:6'
		]);

		if ($request->wantsJson() && !$validator->fails()) {

            // Verificação do email único
            $checkEmailExists = User::where('email', $request->input('email'))->first();
            if ($checkEmailExists) {
                return response()->json(
                    ['errorCode' => 1, 'msg' => 'Email já está em uso.'], 400);
            }

            // Criação do User na DB
            $user= new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json(['msg' => 'Utilizador criado.']);
		} else {
			return response()->json(['errorCode' => -1, 'msg' => 'Request Invalido.'], 400);
		}
	}
}
