<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Employee;
use App\Company;

class EmployeeController extends Controller
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
                return response()->json(Employee::all(), 200);
            } else {
                $companies = Company::where('user_id', $user->id)->pluck('id')->toArray();
                $employees = Employee::whereIn('company_id', $companies)->get();
                return response()->json($employees, 200);
            }
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
            if ($user->role != 'Administrator') {
                $company = Company::find($employee->company_id);
                if ($company->user_id != $user->id) {
                    return response()->json([
                        'message' => "the company is not the user's",
                    ]);
                }
            }
            $employee = new Employee;
            $employee->name = $request->name;
            $employee->lastName = $request->lastName;
            $employee->gender = $request->gender;
            $employee->workArea = $request->workArea;
            $employee->seniority = $request->seniority;
            $employee->salary = $request->salary;
            $employee->company_id = $request->company_id;
            $employee->save();
            return response()->json($employee, 200);
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
            $employee = Employee::find($id);
            if ($user->role != 'Administrator') {
                $company = Company::find($employee->company_id);
                if ($company->user_id != $user->id) {
                    return response()->json([
                        'message' => "the company is not the user's",
                    ]);
                }
            }
            return response()->json($employee, 200);
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
            $employee = Employee::find($id);
            if ($user->role != 'Administrator') {
                $company = Company::find($employee->company_id);
                if ($company->user_id != $user->id) {
                    return response()->json([
                        'message' => "the company is not the user's",
                    ]);
                }
            }
            $employee->name = $request->name;
            $employee->lastName = $request->lastName;
            $employee->gender = $request->gender;
            $employee->workArea = $request->workArea;
            $employee->seniority = $request->seniority;
            $employee->salary = $request->salary;
            $employee->company_id = $request->company_id;
            $employee->save();
            return response()->json($employee, 200);
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
            $employee = Employee::find($id);
            if ($user->role != 'Administrator') {
                $company = Company::find($employee->company_id);
                if ($company->user_id != $user->id) {
                    return response()->json([
                        'message' => "the company is not the user's",
                    ]);
                }
            }
            $employee->delete();
            return response()->json([
                'message' => "Employee deleted",
            ]);
        } else {
            return response()->json([
              'message' => 'User not found',
            ]);
        }
    }
}
