<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\{User, UserCalculation};


class AddUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer=UserCalculation;

        $error=[];
        $validator = Validator::make($request->all(), [
            'login_user_id' => 'required|exists:users,id',
            'mob' => 'required|max:11',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'debit_amount' => 'nullable|string|max:255',
            'credit_amount' => 'nullable|string|max:255',
            'profile_img' => 'nullable|string'
        ], [
            'phone.required' => 'try to use the param of Contact Number like "mob"'
        ]);
        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()
            ],422);
        }
        // name checking
        if ($request->has('name')) {
            $updateMessages[] = 'Name updated';
        }else if(!$request->has('name')){
            $error[] = 'try to use param of Name field like "name"';
        }
        // for email checking
        if ($request->has('email')) {
            $updateMessages[] = 'email updated';
        }else if(!$request->has('email')){
            $error[] = 'try to use param of Email field like "email"';
        }
        // user getting money
        if ($request->has('debit_amount')) {
            $updateMessages[] = 'email updated';
        }else if(!$request->has('debit_amount')){
            $error[] = 'try to use param of Email field like "debit_amount"';
        }
        // for giving money
        if ($request->has('credit_amount')) {
            $updateMessages[] = 'email updated';
        }else if(!$request->has('credit_amount')){
            $error[] = 'try to use param of Email field like "credit_amount"';
        }
        // for giving money
        if ($request->hasFile('profile_img')) {
            $updateMessages[] = 'email updated';
        }else if(!$request->hasFile('profile_img')){
            $error[] = 'try to use param of Email field like "profile_img"';
        }
        // for saving user
        if($error){
            return response()->json([
                'message' => $error
            ]);
        }else if(!$error){
            return response()->json([
                'message' => 'hello'
            ]);
        }
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
