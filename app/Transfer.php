<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
   protected $fillable = [
      'downline', 'nominal', 'status', 'date', 'user_id'
   ];
}
