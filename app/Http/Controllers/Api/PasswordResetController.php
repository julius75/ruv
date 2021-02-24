<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetCode;
use App\Mail\PasswordResetSuccess;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

/**
 * @group Password Management
 *
 * APIs for user reset password
 */
class PasswordResetController extends Controller
{
    /**
     * Send Password Reset Token
     *
     * Send password reset token via Email to the user with provided email address.
     * @bodyParam email string required Email address.
     *
     */
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(),
            ['email' => 'required|email']);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $exists = User::where('email', $request->email)->exists();
        if (!$exists) {
            return response()->json(['message' => 'User does not exist'], Response::HTTP_BAD_REQUEST);
        }
        $token = $this->token();
        $user = User::where('email', $request->email)->first();
        try {
            PasswordReset::create([
                'email' => $user->email,
                'token' => $token,
                'created_at'=>Carbon::now()
            ]);
            $details = [
                'name' => $user->first_name,
                'token' => $token,
                'to' => $user->email,
            ];
            Mail::send(new PasswordResetCode($details));
        } catch (\Exception $e) {
            info($e->getMessage());
            return response()->json(['message' => 'Error sending token. Try again'], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['message' => 'Reset Token successfully sent to '.$request->email], Response::HTTP_OK);
    }

    /**
     * Update Password
     *
     * Update user's password after token verification.
     * @bodyParam email string required Email address.
     * @bodyParam token string required Email token.
     * @bodyParam password string required Password.
     * @bodyParam password_confirm string required Password, must match password.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request)
    {
        if (Auth::user()){
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required',
                    'password' => 'required',
                    'password_confirm' => 'required|same:password',
                ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
            }
        }else{
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required',
                    'token' => 'required',
                    'password' => 'required',
                    'password_confirm' => 'required|same:password',
                ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
            }
            if (!$this->verifyResetToken($request->email, $request->token)) {
                return response()->json(['message' => 'Invalid token'], Response::HTTP_BAD_REQUEST);
            }
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found with that email'], Response::HTTP_BAD_REQUEST);
        }
        $user->update(['password' => Hash::make($request->password)]);
        if (PasswordReset::where('email', $request->email)->exists()){
            PasswordReset::where('email', $request->email)->delete();
        }
        $details = [
            'name' => $user->first_name,
            'to' => $user->email,
        ];
        Mail::send(new PasswordResetSuccess($details));
        return response()->json(['message' => 'Password has been reset sucessfully'], Response::HTTP_OK);
    }

    protected function token($min = 1000, $max = 9999)
    {
        return mt_rand($min, $max);
    }

    protected function verifyResetToken($email, $token)
    {
        return PasswordReset::where('token', $token)->where('email', $email)->exists();
    }
}
