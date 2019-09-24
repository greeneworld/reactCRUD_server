<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Socialite;

class ApiController extends Controller
{
    public $loginAfterSignUp = true;

    public function register(RegisterAuthRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);
        $password = $request->get('password');
        $new_password = $request->get('new_password');

        if ($user) {
            $token = JWTAuth::attempt([
                'email' => $user->email,
                'password' => $password 
            ]);
            if(!$token) {
                return response()->json(['message'=>'The password is invalid '], 400);
            }
            $user->password = Hash::make($new_password);
            $user->save();
            return response()->json(['message'=> 'success'], 200);
        }

        return response()->json(['message'=> 'The token is invalid!'], 400);
    }

    public function socialLogin($social)
    {
        if ($social == "facebook" || $social == "google" || $social == "linkedin") {
            return Socialite::driver($social)->stateless()->redirect();
        } else {
            return Socialite::driver($social)->redirect();           
        }
    }

    public function handleProviderCallback($social)
    {
        if ($social == "facebook" || $social == "google" || $social == "linkedin") {
            $userSocial = Socialite::driver($social)->stateless()->user();
        } else {
            $userSocial = Socialite::driver($social)->user();           
        }
        
        $token = $userSocial->token;
        $user = User::firstOrNew(['email' => $userSocial->getEmail()]);

        if (!$user->id) {
            $user->fill(["name" => $userSocial->getName(),"password"=>bcrypt(str_random(6))]);
            $user->save();
        }

        return response()->json([
            'user'  => [$user],
            'userSocial'  => $userSocial,
            'token' => $token,
        ],200);
    }


    
}