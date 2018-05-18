<?php

namespace App\Http\Controllers;

use DB;
use Input;
use Excel;
use Charts;
use App\Item;
use App\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
   public function index(Request $request)
	{
      $no = 0;

      if (empty($request->date1)) {
         $date1 = date('Y/m/d');
         $date2 = date('Y/m/d');
      }else {
         $date1      =  $request->date1;
         $date2      =  $request->date2;
      }

      $deposits = Deposit::orderBy('date', 'desc')
                           ->whereBetween('date', array($date1, $date2))
                           ->get();

                           $chart = Charts::create('line', 'highcharts')
			->setTitle('My nice chart')
			->setLabels(['First', 'Second', 'Third'])
			->setValues([5,10,20])
			->setDimensions(1000,500)
			->setResponsive(false);

		return view('deposits.index', compact('date1', 'date2', 'deposits', 'no', 'chart'));
	}

   public function importExcel()
	{
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
         // dd($data);
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					$inserts[] = ['bank' => $value->bank, 'date' => date('Y-m-d', strtotime($value->tanggal)), 'nominal' => $value->deposit];
				}
            // dd($inserts);
				if(!empty($inserts)){
					DB::table('deposits')->insert($inserts);
					// dd('Insert Record successfully.');
               return back()->with('success', 'Data imported');
				}else {
               return back()->with('warning', 'Can not import data');
            }
			}
		}

		return back()->with('warning', 'Please select file');
	}
}
