<?php

namespace App\Http\Controllers\Api;

use App\Events\InitiateSendJambopayAirtime;
use App\Http\Controllers\Controller;
use App\Jobs\SendJambopayAirtime;
use App\Models\PhoneNumber;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SafaricomAirtimeController extends Controller
{
//    public function initiate_sending_airtime(Request $request)
//    {
//        $validator = Validator::make($request->all(),
//            [
//                'phone_number' => 'required',
//                'amount' => 'required|integer|min:10|max:10000',
//                'provider_id' => 'required|exists:providers,id',
//            ]);
//        if ($validator->fails()) {
//            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
//        }
//        $user = Auth::user();
//        $phone_number = PhoneNumber::where('phone_number', '=', $request->phone_number)->first();
//        if ($phone_number){
//            $phone_number_id = $phone_number->id;
//            $phone_number = $phone_number->phone_number;
//        }else{
//            $phone_number_id = null;
//            $phone_number = $request->phone_number;
//        }
//        $provider = Provider::find($request->get('provider_id'));
//        if ($provider->id == 4 || $provider->id == 5 || $provider->id == 6)
//        {
//            //safaricom
//            if ($provider->name == "Safaricom"){
//                $jp_provider = 4;
//            }
//            //telkom
//            elseif ($provider->name == "Telkom"){
//                $jp_provider = 2;
//            }
//            //airtel
//            elseif ($provider->name == "Airtel"){
//                $jp_provider = 1;
//            }else{
//                $jp_provider = null;
//            }
//            if ($jp_provider != null){
//                $data['recipientPhone'] = $phone_number;
//                $data['amount'] = $request->get('amount');
//                $data['provider'] = $jp_provider;
//
//
//                //-- add additional logic to store records in the database --//
//
//
//
//                //pass data to the event
//                //event(new InitiateSendJambopayAirtime($data));
//                dispatch(new SendJambopayAirtime($data))->delay(now()->addSeconds(5));
//
//                return response()->json(['message'=>'You will receive airtime shortly'], Response::HTTP_OK);
//            }
//            return response()->json(['message'=>'Something Went Wrong on our side, try again later'], Response::HTTP_BAD_REQUEST);
//        }
//        return response()->json(['message'=>'Something Went Wrong on our side, try again later'], Response::HTTP_BAD_REQUEST);
//    }
}
