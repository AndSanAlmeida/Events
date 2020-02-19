<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use GuzzleHttp\Client as Client;
use Illuminate\Http\Request;

//define('YOUR_SERVER_URL', env('APP_URL'));
define('YOUR_SERVER_URL', 'http://events.test');
define('CLIENT_ID', '2');
define('CLIENT_SECRET', '5IuHcoJOFFZJ3LaiJlqBnnLiVDnM1EegnfXbVv0q');

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $user = User::orWhere('email', $request->email)->first();
        if (!$user) {
            return response()->json(['data' => 'Utilizador não encontrado.'],400);
            var_dump(response()->json(['data' => 'Utilizador não encontrado.'],401));
        }
        
        $http = new Client;
        $response = $http->post(YOUR_SERVER_URL.'/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => CLIENT_ID,
                'client_secret' => CLIENT_SECRET,
                'email' => $request->email,
                'password' => $request->password,
                'scope' => ''
            ], 'exceptions' => false,]);

        $errorCode= $response->getStatusCode();
        if ($errorCode=='200') {
            return json_decode((string) $response->getBody(), true);
        } else {
            return response()->json(['data'=>'Credenciais do utilizador inválidas.'], $errorCode);
        }

    }

    public function logout()
    {
        \Auth::guard('api')->user()->token()->revoke();
        \Auth::guard('api')->user()->token()->delete();
        
        return response()->json(['msg'=>'Token revoked'], 200);
    }
}
