<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use \App\Models\User;
use App\Models\UserDevice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group User Devices
 *
 * APIs for managing user device tokens for push notifications
 */
class UserDeviceController extends Controller
{
    /**
     * Create/Update users device token
     *
     * Registers Users' Device tokens for sending push notifications
     * presenting the OTP Passcode in the next stage before user login.
     * @bodyParam email string required Email Address.
     * @bodyParam token string required Device Token.
     * @bodyParam type string required Device Type, submit either ios OR android.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|exists:users,email',
                'token' => 'required',
                'type' => 'required|in:android,ios',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $user =  User::where('email', '=', $request->get('email'))->first();
        $device = UserDevice::where('user_id', '=', $user->id)->first();
        if ($device){
            $device->update([
                'token'=>$request->get('token'),
                'type'=>$request->get('type'),
                'updated_at'=>Carbon::now()
            ]);
            return response()->json(
                [
                    'message' => 'Device Updated Successfully'
                ],
                Response::HTTP_OK
            );
        }else{
            $user->device()->create([
                'token'=>$request->get('token'),
                'type'=>$request->get('type'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
            return response()->json(
                [
                    'message' => 'Device Created Successfully'
                ],
                Response::HTTP_OK
            );
        }
    }
}
