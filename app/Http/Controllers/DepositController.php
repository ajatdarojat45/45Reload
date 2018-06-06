<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Excel;
use Charts;
use App\Item;
use App\Deposit;
use Vsmoraes\Pdf\Pdf;
use Illuminate\Http\Request;

class DepositController extends Controller
{
   private $pdf;

    public function __construct(Pdf $pdf)
    {
        $this->pdf = $pdf;
    }

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

      $deposits = Deposit::where('user_id', Auth::user()->id)
                           ->whereBetween('date', array($date1, $date2))
                           ->orderBy('date', 'asc')
                           ->get();

		return view('deposits.index', compact('date1', 'date2', 'deposits', 'no'));
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
                     'bank' => $value->bank,
                     'date' => date('Y-m-d', strtotime($value->tanggal)),
                     'nominal' => $value->deposit,
                     'user_id' => Auth::user()->id
                  ];
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
         } catch (\Exception $e) {
            return back()->with('warning', 'Sorry your file or data format does not comply with the rules. Please check and try again.');
         }

		}

		return back()->with('warning', 'Please select file');
	}

   public function exportToExcel($date1, $date2, $type)
	{
      $data = Deposit::select('bank', 'nominal', 'date')
                     ->where('user_id', Auth::user()->id)
                     ->whereBetween('date', array($date1, $date2))
                     ->orderBy('date', 'asc')
                     ->get()
                     ->toArray();

		return Excel::create('deposit', function($excel) use ($data) {
			$excel->sheet('deposit sheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}

   public function exportToPdf($date1, $date2)
   {
      $deposits = Deposit::where('user_id', Auth::user()->id)
                     ->whereBetween('date', array($date1, $date2))
                     ->orderBy('date', 'asc')
                     ->get();

      $html = view('deposits.indexPdf', compact('deposits', 'date1', 'date2'))->render();

      return $this->pdf
           ->load($html, 'A4', 'landscape')
           ->show();
   }

   public function destroy($id)
   {
      $deposit = Deposit::findOrFail($id);

      if($deposit->isOwner()){
         $deposit->delete();
      }else{
         return back()->with('warning', 'You can not delete this data.');
      }

      return back()->with('success', 'Data Deleted');
   }

   public function multipleDestroy(Request $request)
   {
      // cek apakah datanya kosong atau ngga
      if ($request->deposits != null) {
         // melakukan delete dengan looping
         foreach ($request->deposits as $data) {
            $deposit = Deposit::where('id', $data)
                                       ->where('user_id', Auth::user()->id)
                                       ->first();
            $deposit->delete();
         }
         return back()->with('success', 'Data Deleted');

      }else {
         return back()->with('warning', 'Please select data.');
      }
   }

   public function store(Request $request)
   {
      $this->validate($request, [
         'bank'      => 'required',
         'nominal'   => 'required',
         'date'      => 'required',
      ]);

      $deposit = Deposit::create([
         'bank'      => $request->bank,
         'date'      => $request->date,
         'nominal'   => $request->nominal,
         'user_id'   => Auth::user()->id,
      ]);

      return back()->with('success', 'Data saved');
   }
}
