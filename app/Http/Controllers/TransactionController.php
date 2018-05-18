<?php

namespace App\Http\Controllers;

use DB;
use Input;
use Excel;
use Charts;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
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

      $transactions = Transaction::orderBy('date', 'desc')
                           ->whereBetween('date', array($date1, $date2))
                           ->get();

		return view('transactions.index', compact('date1', 'date2', 'transactions', 'no'));
	}

   public function importExcel()
	{
		if(Input::hasFile('import_file')){

         try {
            $path = Input::file('import_file')->getRealPath();
   			$data = Excel::load($path, function($reader) {
   			})->get();
            // dd($data);
   			if(!empty($data) && $data->count()){
   				foreach ($data as $key => $value) {
   					$inserts[] = [
                     'date' => date('Y-m-d', strtotime($value->tanggal)),
                     'costumer' => $value->tujuan,
                     'distributor_price' => $value->distributor,
                     'sell_price' => $value->jual,
                     'profit' => $value->laba,
                     'status' => $value->status,
                  ];
   				}
               // dd($inserts);
   				if(!empty($inserts)){
   					DB::table('transactions')->insert($inserts);
   					// dd('Insert Record successfully.');
                  return back()->with('success', 'Data imported');
   				}else {
                  return back()->with('warning', 'Can not import data');
               }
   			}
         } catch (\Exception $e) {
            return back()->with('warning', 'Sorry your file or data format does not comply with the rules. Please check and try again.');
         }

		}

		return back()->with('warning', 'Please select file');
	}
}
