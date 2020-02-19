<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request) {
        // Validator
		$validator = Validator::make($request->all(), [
            'fname' => 'required|max:10',
            'lname' => 'required|max:15',
			'email' => 'required|email|max:255',
			'password' => 'required|min:6'
		]);

		if ($request->wantsJson() && !$validator->fails()) {

            // Verificação do email unico
            $checkEmailExists = User::where('email', $request->input('email'))->first();
            if ($checkEmailExists) {
                return response()->json(
                    ['errorCode' => 1, 'msg' => 'Email já está em uso.'], 400);
            }

            // Criação do User na DB
            $user= new User();
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json(['msg' => 'Utilizador criado.']);
		} else {
			return response()->json(['errorCode' => -1, 'msg' => 'Request Invalido.'], 400);
		}
	}
}
