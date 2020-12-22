<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LicenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getLicense(Request $request)
    {
    	// $request->all();
        $data = $request->data;
        $client_id = $data['client_id'];
        $license_period = $data['license_period'];
        $license = 'client_id'.$client_id.'expires_in'.$license_period.'months';
    	return $hex = bin2hex($license);
        // return $bin = hex2bin($hex);
    }

    public function activateLicense(Request $request)
    {
        // return $request->all();
        $license_key = $request->license_key;
        return $bin = hex2bin($license_key);

        // $client_id = $data['client_id'];
        // $license_period = $data['license_period'];
        // $license = 'client_id'.$client_id.'expires_in'.$license_period.'months';
        // return $bin = hex2bin($hex);
    }

    public function getUser(Request $request)
    {
        // return $request->all();
        $client_id = $request->client_id;

        return $user = User::find($client_id)->get();
    }
}
