<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\TransportManager;
use App\Mail\RecoverPassword;
use Swift_Mailer;

//define('YOUR_SERVER_URL', env('APP_URL'));
define('YOUR_SERVER_URL', 'http://events.test');
define('CLIENT_ID', '2');
define('CLIENT_SECRET', 'g0wszcQzxlUafgAoQDCTloFaDuXbz9QQYzhcKM3C');

class LoginControllerAPI extends Controller
{   
    use SendsPasswordResetEmails;

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['data' => 'User not Found.'],400);
            var_dump(response()->json(['data' => 'User not Found.'],401));
        }
        
        $http = new \GuzzleHttp\Client();
        $response = $http->post(YOUR_SERVER_URL.'/oauth/token', [            
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => CLIENT_ID,
                'client_secret' => CLIENT_SECRET,
                'username' => $request->email,
                'password' => $request->password,
                'scope' => ''
            ], 'exceptions' => false,]);

        $errorCode = $response->getStatusCode();
        if ($errorCode=='200') {
            return json_decode((string) $response->getBody(), true);
        } else {
            return response()->json(['data'=>'Invalid Credentials'], $errorCode);
        }

    }

    public function logout()
    {
        \Auth::guard('api')->user()->token()->revoke();
        \Auth::guard('api')->user()->token()->delete();
        
        return response()->json(['msg'=>'Token revoked'], 200);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($request->wantsJson() && !$validator->fails()) {
            $user = User::where('email', $request->input('email'))->first();
            if (!$user) {
                return response()->json(['msg' => trans('passwords.user')], 400);
            }

            $token = $this->broker()->createToken($user);

            try {

                $config = DB::table('config')->first();
                $mailConfigs = json_decode($config->platform_email_properties);

                config([
                    'mail.host' => $mailConfigs->host,
                    'mail.port' => $mailConfigs->port,
                    'mail.encryption' => $mailConfigs->encryption,
                    'mail.username' => $config->platform_email,
                    'mail.password' => $mailConfigs->password
                ]);

                $app = App::getInstance();
                $app->singleton('swift.transport', function ($app) {
                    return new TransportManager($app);
                });
                $mailer = new Swift_Mailer($app['swift.transport']->driver());
                Mail::setSwiftMailer($mailer);

                Mail::to($user->email)->queue(new RecoverPassword($token, $user->email, $config->platform_email));
                return response()->json(['msg' => 'Email enviado.']);
            } catch (\Exception $e) {
                return response()->json(['msg' => 'Erro ao enviar email.', 'exc' => $e->getMessage()], 400);
            }
        } else {
            return response()->json(['msg' => 'Request inválido.'], 400);
        }
    }
}
