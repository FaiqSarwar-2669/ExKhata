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
        $userCalculation = new UserCalculation();

        $error=[];
        $updateMessages=[];
        $validator = Validator::make($request->all(), [
            'login_user_id' => 'required',
            'mob' => 'required|max:11',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'debit_amount' => 'nullable|string|max:255',
            'credit_amount' => 'nullable|string|max:255'
            // 'profile_img' => 'nullable|string'
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
            $userCalculation->Name=$request->input('name');
            $updateMessages[] = 'Name updated';
        }else if(!$request->has('name')){
            $error[] = 'try to use param of Name field like "name"';
        }
        // for email checking
        if ($request->has('email')) {
            $userCalculation->Email=$request->input('email');
            $updateMessages[] = 'email updated';
        }else if(!$request->has('email')){
            $error[] = 'try to use param of Email field like "email"';
        }
        // user getting money
        if ($request->has('debit_amount')) {
            $userCalculation->UserTake=$request->input('debit_amount');
            $updateMessages[] = 'Debit Amount Updated';
        }else if(!$request->has('debit_amount')){
            $error[] = 'try to use param of debit amount field like "debit_amount"';
        }
        // for giving money
        if ($request->has('credit_amount')) {
            $userCalculation->UserGive=$request->input('credit_amount');
            $updateMessages[] = 'credit Amount Updated';
        }else if(!$request->has('credit_amount')){
            $error[] = 'try to use param of credit amount field like "credit_amount"';
        }
        // for mobile number
        if ($request->has('mob')) {
            $userCalculation->PhoneNumber = $request->input('mob');
            $updateMessages[] = 'Mobile Number Updated';
        }else if(!$request->has('mob')){
            $error[] = 'try to use param of credit amount field like "mob"';
        }
        // for profile picture

        if ($request->hasFile('profile_img')) {
            if ($userCalculation->profile_img) {
                Storage::delete($userCalculation->profile_img);
                DB::table('usercalculation')->where('id', $id)->update(['profile_img' => null]);
            }

            $name = $request->file('profile_img')->getClientOriginalName();
            $fileName = $id . '.' . $name;
            $path = $request->file('profile_img')->storeAs('public/images', $fileName);

            $user->profile_img = $path;
            $updateMessages[] = 'Profile Picture updated';
        }
        // if ($request->hasFile('profile_img')) {
        //     $updateMessages[] = 'profile picture updated';
        // }else if(!$request->hasFile('profile_img')){
        //     $error[] = 'try to use param of profile picture field like "profile_img"';
        // }

        // for saving user
        if($error){
            return response()->json([
                'message' => $error
            ]);
        }else if(!$error){
            $userCalculation->login_user_id=$request->input('login_user_id');
            $userCalculation->save();
            if(count($updateMessages) === 5){
                return response()->json([
                    'message' => 'Successfully created the User'
                ]);
            }else{
                return response()->json([
                    'message' => $updateMessages
                ]);
            }
            
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
        $error=[];
        $updateMessages=[];
        $validator = Validator::make($request->all(), [
            'mob' => 'nullable|max:11',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'debit_amount' => 'nullable|string|max:255',
            'credit_amount' => 'nullable|string|max:255'
            // 'profile_img' => 'nullable|string'
        ], [
            'phone.required' => 'try to use the param of Contact Number like "mob"'
        ]);
        $userCalculation = UserCalculation::find($id);
        if(!$userCalculation){
            return response()->json([
                'message' => 'User not exists'
            ],422);
        }
        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()
            ],422);
        }
        // name checking
        if ($request->has('name')) {
            $userCalculation->Name=$request->input('name');
            $updateMessages[] = 'Name updated';
        }else if(!$request->has('name')){
            $error[] = 'try to use param of Name field like "name"';
        }
        // for email checking
        if ($request->has('email')) {
            $userCalculation->Email=$request->input('email');
            $updateMessages[] = 'email updated';
        }else if(!$request->has('email')){
            $error[] = 'try to use param of Email field like "email"';
        }
        // user getting money
        if ($request->has('debit_amount')) {
            $userCalculation->UserTake=$request->input('debit_amount');
            $updateMessages[] = 'Debit Amount Updated';
        }else if(!$request->has('debit_amount')){
            $error[] = 'try to use param of debit amount field like "debit_amount"';
        }
        // for giving money
        if ($request->has('credit_amount')) {
            $userCalculation->UserGive=$request->input('credit_amount');
            $updateMessages[] = 'credit Amount Updated';
        }else if(!$request->has('credit_amount')){
            $error[] = 'try to use param of credit amount field like "credit_amount"';
        }
        // for mobile number
        if ($request->has('mob')) {
            $userCalculation->PhoneNumber = $request->input('mob');
            $updateMessages[] = 'Mobile Number Updated';
        }else if(!$request->has('mob')){
            $error[] = 'try to use param of credit amount field like "mob"';
        }
        // for profile picture

        // if ($request->hasFile('profile_img')) {
        //     $updateMessages[] = 'profile picture updated';
        // }else if(!$request->hasFile('profile_img')){
        //     $error[] = 'try to use param of profile picture field like "profile_img"';
        // }

        // for saving user
        if($error){
            return response()->json([
                'message' => $error
            ]);
        }else if(!$error){
            $userCalculation->save();
            if(count($updateMessages) === 5){
                return response()->json([
                    'message' => 'Successfully Updated the User',
                    'count' => count($error)
                ]);
            }else{
                return response()->json([
                    'message' => $updateMessages
                ]);
            }
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
