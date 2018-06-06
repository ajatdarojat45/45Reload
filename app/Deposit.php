<?php

namespace App;

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
}
