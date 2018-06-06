<?php

namespace App;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   protected $fillable = [
      'date', 'customer', 'distributor_price', 'sell_price', 'profit', 'status', 'user_id'
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
         $transactions = Transaction::select('transactions.date', DB::raw('DATE(date) as date'), DB::raw('SUM(transactions.distributor_price) as distributor_price'), DB::raw('SUM(transactions.sell_price) as sell_price'), DB::raw('SUM(transactions.profit) as profit'))
                              ->whereBetween('transactions.date', array($date1, $date2))
                              ->groupBy('date')
                              ->get();
      }elseif ($type == 'month') {
         $transactions = Transaction::select('transactions.date', DB::raw('MONTH(date) as month'), DB::raw('SUM(transactions.distributor_price) as distributor_price'), DB::raw('SUM(transactions.sell_price) as sell_price'), DB::raw('SUM(transactions.profit) as profit'))
                              ->whereBetween('transactions.date', array($date1, $date2))
                              ->groupBy('month')
                              ->get();
      }else {
         $transactions = Transaction::select('transactions.date', DB::raw('YEAR(date) as year'), DB::raw('SUM(transactions.distributor_price) as distributor_price'), DB::raw('SUM(transactions.sell_price) as sell_price'), DB::raw('SUM(transactions.profit) as profit'))
                              ->whereBetween('transactions.date', array($date1, $date2))
                              ->groupBy('year')
                              ->get();
      }

      // jika datanya tidak sama dengan - disimpan dalam bentuk array
      if (!count($transactions) == 0) {
         foreach ($transactions as $transaction) {
            $distributorPriceValues[]  =  $transaction->distributor_price;
            $sellPriceValue[]          =  $transaction->sell_price;
            $profitValues[]            =  $transaction->profit;
            if ($type == 'date') {
               $labels[]                  = date('d M. Y', strtotime($transaction->date));
            }elseif ($type == 'month') {
               $labels[]                  = date('M. Y', strtotime($transaction->date));
            }else {
               $labels[]                  = date('Y', strtotime($transaction->date));
            }
         }
      }else {
         $distributorPriceValues[]  =  0;
         $sellPriceValue[]          =  0;
         $profitValues[]            =  0;
         $labels[]                  = '';
      }

      $data = ['labels' => $labels, 'distributorPriceValues' => $distributorPriceValues, 'sellPriceValues' => $sellPriceValue, 'profitValues' => $profitValues];

      return $data;
   }
}
