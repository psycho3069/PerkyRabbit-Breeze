<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;


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
        $bin = hex2bin($license_key);
        
        $a = explode('client_id',$bin);
        $b = explode('months',$a[1]);
        $c = explode('expires_in',$b[0]);

        $client_id = $c[0];
        $license_period = $c[1];

        
        $expire_date = User::find($client_id)->get()->first()->expire_date;

        if ($expire_date == null) {
            $date = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        } else{
            $date = Carbon::createFromFormat('Y-m-d', $expire_date);
        }

        // $date = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $daysToAdd = $license_period*30;
        $date = $date->addDays($daysToAdd);
        $expire_date = date('Y-m-d', strtotime($date));

        $result = User::where('id',$client_id)->first()->update([
            'license_key' => $license_key,
            'expire_date' => $expire_date,
        ]);

        $date = Carbon::createFromFormat('Y-m-d', $expire_date);
        $date = date('d/m/Y', strtotime($date));

        $msg = "Congratulations!! Your License Has Been Activated. It will work till ".$date;

        return $msg;

    }

    public function getUser(Request $request)
    {
        // return $request->all();
        $client_id = $request->client_id;

        return $user = User::find($client_id)->get();
    }
}
