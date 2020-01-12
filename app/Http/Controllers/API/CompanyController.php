<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;
use App\User;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = $request->header('Authorization');
        $user = User::where('api_token', $token)->first();
        if ($user) {
            if ($user->role == 'Administrator') {
                return response()->json(Company::all(), 200);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $request->header('Authorization');
        $user = User::where('api_token', $token)->first();
        if ($user) {
            if ($user->role == 'Administrator') {
                $company = new Company;
                $company->name = $request->name;
                $company->category = $request->category;
                $company->address = $request->address;
                $company->user_id = $request->user_id;
                $company->save();
                return response()->json($company, 200);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $token = $request->header('Authorization');
        $user = User::where('api_token', $token)->first();
        if ($user) {
            if ($user->role == 'Administrator') {
                return response()->json(Company::find($id), 200);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $token = $request->header('Authorization');
        $user = User::where('api_token', $token)->first();
        if ($user) {
            if ($user->role == 'Administrator') {
                $company = Company::find($id);
                $company->name = $request->name;
                $company->category = $request->category;
                $company->address = $request->address;
                $company->user_id = $request->user_id;
                $company->save();
                return response()->json($company, 200);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $token = $request->header('Authorization');
        $user = User::where('api_token', $token)->first();
        if ($user) {
            if ($user->role == 'Administrator') {
                $company = Company::find($id);
                $company->delete();
                return response()->json([
                    'message' => "Company deleted",
                ]);
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

    public function method1() {
        $companies_result = [];
        $companies = Company::all();
        foreach ($companies as $company) {
            if (count($company->employees) >= 5)
                array_push($companies_result, $company);
        }
        return $companies_result;
    }

    public function method2() {
        $companies_result = [];
        $companies = $this->method1();
        foreach ($companies as $company) {
            if ($company->category == 'Tech')
                array_push($companies_result, $company);
        }
        return $companies_result;
    }
}
