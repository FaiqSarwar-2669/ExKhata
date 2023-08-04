<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class RegisterationController extends Controller
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(422);
        }else{
            $data = [
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')), 
            ];
            DB::table('users')->insert($data);
            return response()->json([
                'message' => 'Successfully Registerd'
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return response()->json([
            'data' => $user,
            
        ],200);
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
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'string|max:255',
            'MobileNumber' => 'nullable|digits:11'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(422);
        }

        $user = User::find($id);
        $updateMessages = [];

        if ($request->hasFile('profile_picture')) {
            if ($user->ProfilePicture) {
                Storage::delete($user->ProfilePicture);
                DB::table('users')->where('id', $id)->update(['ProfilePicture' => null]);
            }

            $name = $request->file('profile_picture')->getClientOriginalName();
            $fileName = $id . '.' . $name;
            $path = $request->file('profile_picture')->storeAs('public/images', $fileName);

            $user->ProfilePicture = $path;
            $updateMessages[] = 'Profile Picture updated';
        }

        if ($request->has('name')) {
            $user->name = $request->input('name');
            $updateMessages[] = 'Name updated';
        }

        if ($request->has('MobileNumber')) {
            $user->MobileNumber = $request->input('MobileNumber');
            $updateMessages[] = 'Mobile Number updated';
        }

        if (!empty($updateMessages)) {
            $user->save();
        }

        return response()->json([
            'message' => $updateMessages,
        ]);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}