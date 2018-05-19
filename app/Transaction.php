<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   protected $fillable = [
      'date', 'costumer', 'distributor_price', 'sell_price', 'profit', 'status', 'user_id'
   ];
}
