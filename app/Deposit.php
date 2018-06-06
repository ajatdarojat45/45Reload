<?php

namespace App;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
   protected $fillable = [
      'date', 'nominal', 'bank', 'user_id'
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
         $deposits = Deposit::select('deposits.date', DB::raw('DATE(date) as date'), DB::raw('SUM(deposits.nominal) as total_nominal'))
                              ->whereBetween('deposits.date', array($date1, $date2))
                              ->groupBy('date')
                              ->get();

      }elseif ($type == 'month') {
         $deposits = Deposit::select('deposits.date', DB::raw('MONTH(date) as month'), DB::raw('SUM(deposits.nominal) as total_nominal'))
                              ->whereBetween('deposits.date', array($date1, $date2))
                              ->groupBy('month')
                              ->get();
      }else {
         $deposits = Deposit::select('deposits.date', DB::raw('YEAR(date) as year'), DB::raw('SUM(deposits.nominal) as total_nominal'))
                              ->whereBetween('deposits.date', array($date1, $date2))
                              ->groupBy('year')
                              ->get();
      }

      // jika datanya tidak sama dengan - disimpan dalam bentuk array
      if (!count($deposits) == 0) {
         foreach ($deposits as $deposit) {
            $nominal[] = $deposit->total_nominal;
            if ($type == 'date') {
               $labels[] = date('d M. Y', strtotime($deposit->date));
            }elseif ($type == 'month') {
               $labels[] = date('M. Y', strtotime($deposit->date));
            }else {
               $labels[] = date('Y', strtotime($deposit->date));
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
