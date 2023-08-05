<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Mail\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ResetPasswordMail;


class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(422);
        }
        $user = User::where('email', $request->email)->first();
        if($user){
            $randomPassword = Str::random(6);
            $user->password = Hash::make($randomPassword);
            $user->save();
            try {
                Mail::to($request->email)->send(new ResetPasswordMail($randomPassword));
                return response()->json(['message' => 'Password reset Check your Email'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }else{
            return response()->json(['error' => 'Invalid email'], 500);
        }
    }
}
