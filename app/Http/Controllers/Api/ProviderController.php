<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * @group  Teleco Providers
 * @authenticated
 * API for listing Teleco Providers
 */
class ProviderController extends Controller
{
    /**
     * Fetch Teleco Providers
     *
     */
    public function index(){
        $providers = Provider::select(['id', 'name', 'logo'])->get();
        return response()->json(['message'=>compact('providers'), Response::HTTP_OK]);
    }
}
