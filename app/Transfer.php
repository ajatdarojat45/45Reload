<?php

namespace App;

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
}
