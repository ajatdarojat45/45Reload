<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
   protected $fillable = [
      'date', 'nominal', 'bank'
   ];
}
