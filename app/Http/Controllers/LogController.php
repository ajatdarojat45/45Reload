<?php

namespace App\Http\Controllers;

use Auth;
use App\Log;
use Location;
use Illuminate\Http\Request;

class LogController extends Controller
{
   public function store(Request $request)
   {
      $ip         = $request->ip();
      $location   = Location::get($ip);

      $log = Log::create([
         'country_name' => $location->countryName,
         'county_code'  => $location->countryCode,
         'region_code'  => $location->regionCode,
         'region_name'  => $location->regionName,
         'city_name'    => $location->cityName,
         'zip_code'     => $location->zipCode,
         'iso_code'     => $location->isoCode,
         'postal_code'  => $location->postalCode,
         'latitude'     => $location->latitude,
         'longitude'    => $location->longitude,
         'metro_code'   => $location->metroCode,
         'area_code'    => $location->areaCode,
         'date'         => date('Y/m/d'),
         'user_id'      => Auth::user()->id
      ]);

      return redirect('dashboard');
   }

   public function index(Request $request)
   {
      if (Auth::user()->id != 1) {
         return redirect('dashboard');
      }

      $no = 0;
      $date3 = '';

      if (empty($request->date1)) {
         $date1      = date('Y/m/d');
         $date2      = date('Y/m/d');
      }else {
         $date1      =  $request->date1;
         $date2      =  $request->date2;
      }

      if ($date2 < $date1) {
         $date3 = $date2;
         $date2 = $date1;
         $date1 = $date3;
      }

      $logs = new Log;
      $logs = $logs->getData($date1, $date2);

      return view('logs.index', compact('logs', 'date1', 'date2', 'no'));
   }
}
