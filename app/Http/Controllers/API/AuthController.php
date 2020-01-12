<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{ 
    private $apiToken;

    public function __construct()
    {
      // Unique Token
      $this->apiToken = hash('sha256', Str::random(60));
    }

    public function postLogin(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if ($user) {
            $password = hash('sha256', $request->password);
            if ($password == $user->password) {
                $postArray = ['api_token' => $this->apiToken];
                $login = User::where('username',$request->username)->update($postArray);
                if ($login) {
                    return response()->json([
                        'username' => $user->username,
                        'api_token' => $this->apiToken,
                    ]);
                }
            } else {
                return response()->json([
                'message' => 'Invalid Authentication',
                ]);
            }
        } else {
          return response()->json([
          'message' => 'Invalid Authentication',
          ]);
        }
    }
    
    public function postLogout(Request $request)
    {
      $token = $request->header('Authorization');
      $user = User::where('api_token', $token)->first();
      if ($user) {
        $postArray = ['api_token' => null];
        $logout = User::where('id', $user->id)->update($postArray);
        if($logout) {
          return response()->json([
            'message' => 'User Logged Out',
          ]);
        }
      } else {
        return response()->json([
          'message' => 'User not found',
        ]);
      }
    }
}
