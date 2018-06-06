<?php

namespace App;

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
}
