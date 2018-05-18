<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class GlobalHelper {

   public static function f_currency($value)
	{
		$value=strrev($value);
		$temp="";
		for($i=0;$i<strlen($value);$i++)$temp=$temp.substr($value,$i,1).($i%3==2?".":"");
		return trim(strrev($temp).",-",".");
	}
}
