<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Company;

class UserController extends Controller
{
    public function showCompanies(Request $request) {
        $token = $request->header('Authorization');
        $user = User::where('api_token', $token)->first();
        if ($user) {
            if ($user->role != 'Administrator') {
                return response()->json(Company::where('user_id', $user->id)->get());
            }
            return response()->json([
              'message' => 'User is Administrator',
            ]);
        } else {
            return response()->json([
              'message' => 'User not found',
            ]);
        }
    }

    public function index(Request $request) {
        $token = $request->header('Authorization');
        $user = User::where('api_token', $token)->first();
        if ($user) {
            if ($user->role == 'Administrator') {
                return response()->json(User::all(), 200);
            }
            return response()->json([
                'message' => 'User is not admin',
              ]);
        } else {
            return response()->json([
              'message' => 'User not found',
            ]);
        }
    }
}
