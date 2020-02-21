<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\User;
use Intervention\Image\Facades\Image;

class UserControllerAPI extends Controller
{
    public function store(Request $request) {
        // Validator
		$validator = Validator::make($request->all(), [
            'firstName' => 'required|max:15',
            'lastName' => 'required|max:15',
			'email' => 'required|email|max:80',
			'password' => 'required|min:6'
        ]);

		if ($request->wantsJson() && !$validator->fails()) {

            // Verificação do email único
            $checkEmailExists = User::where('email', $request->input('email'))->first();
            if ($checkEmailExists) {
                return response()->json(
                    ['errorCode' => 1, 'msg' => 'This email is already taken.'], 400);
            }

            // Criação do User na DB
            $user= new User();
            $user->first_name = $request->firstName;
            $user->last_name = $request->lastName;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json(['msg' => 'User Created.']);
		} else {
			return response()->json(['errorCode' => -1, 'msg' => 'Invalid Request.'], 400);
		}
    }
    
    public function updateUserInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:15',
            'lastName' => 'required|string|max:15',
            'email' => 'required|email',
        ]);

        if ($request->wantsJson() && !$validator->fails()) {

            $checkEmailExists = User::where('id', '<>', $request->user()->id)
                ->where('email', $request->input('email'))
                ->first();

            if ($checkEmailExists) {
                return response()->json(
                    ['errorCode' => 1, 'msg' => 'Email já se encontra a ser utilizado.'], 400);
            }

            $user = User::findOrFail($request->user()->id);

            $user->first_name = $request->input('firstName');
            $user->last_name = $request->input('lastName');
            $user->email = $request->input('email');
            $user->save();

            return response()->json(['msg' => 'Utilizador atualizado.']);


        } else {
            return response()->json(['errorCode' => -1, 'msg' => 'Request inválido.'], 400);
        }

    }

    public function updateUserAvatar(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image64:jpeg,jpg,png'
        ]);

        if ($request->wantsJson() && !$validator->fails()) {

            $imageData = $request->get('avatar');
            $user = Auth::user();

            if ($user->avatar == "empty.png") {
                $user->avatar = $user->id . ".png";
                $user->save();
            } else {
                unlink("img/avatars/" . $user->id . ".png");
            }

            $img = Image::make($imageData);
            $img->resize(200, 200)->save("img/avatars/" . $user->id . ".png");

        } else {
            return response()->json(['msg' => 'Request inválido.'], 400);
        }

        return response()->json(200);

    }
}
