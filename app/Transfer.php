<?php

namespace App;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
   protected $fillable = [
      'downline', 'nominal', 'status', 'date', 'user_id'
   ];

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function isOwner()
   {
      if(Auth::guest())
           return false;

     return Auth::user()->id == $this->user->id;
   }

   public function report($date1, $date2, $type)
   {
      if ($type == 'date') {
         $transfers = Transfer::select('transfers.date', DB::raw('DATE(date) as date'), DB::raw('SUM(transfers.nominal) as total_nominal'))
                              ->whereBetween('transfers.date', array($date1, $date2))
                              ->groupBy('date')
                              ->get();

      }elseif ($type == 'month') {
         $transfers = Transfer::select('transfers.date', DB::raw('MONTH(date) as month'), DB::raw('SUM(transfers.nominal) as total_nominal'))
                              ->whereBetween('transfers.date', array($date1, $date2))
                              ->groupBy('month')
                              ->get();

      }else {
         $transfers = Transfer::select('transfers.date', DB::raw('YEAR(date) as year'), DB::raw('SUM(transfers.nominal) as total_nominal'))
                              ->whereBetween('transfers.date', array($date1, $date2))
                              ->groupBy('year')
                              ->get();
      }

      // jika datanya tidak sama dengan - disimpan dalam bentuk array
      if (!count($transfers) == 0) {
         foreach ($transfers as $transfer) {
            $nominal[] = $transfer->total_nominal;
            if ($type == 'date') {
               $labels[] = date('d M. Y', strtotime($transfer->date));
            }elseif ($type == 'month') {
               $labels[] = date('M. Y', strtotime($transfer->date));
            }else {
               $labels[] = date('Y', strtotime($transfer->date));
            }
         }
      }else {
         $nominal[] = 0;
         $labels[] = '';
      }

      $data = ['labels' => $labels, 'values' => $nominal];

      return $data;
   }
}
