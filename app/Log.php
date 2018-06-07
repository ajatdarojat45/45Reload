<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
   protected $fillable = [
      'country_name', 'county_code', 'region_code', 'region_name', 'city_name', 'zip_code', 'iso_code', 'postal_code', 'latitude', 'longitude', 'metro_code', 'area_code', 'user_id', 'date'
   ];

   protected $with = [
      'user'
   ];

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function getData($date1, $date2)
   {
      $logs = $this->whereBetween('date', array($date1, $date2))
                  ->orderBy('date', 'desc')
                  ->get();

      return $logs;
   }
}
