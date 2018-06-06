<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Excel;
use Charts;
use App\Transfer;
use Vsmoraes\Pdf\Pdf;
use Illuminate\Http\Request;

class TransferController extends Controller
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

      $transfers = Transfer::where('user_id', Auth::user()->id)
                           ->whereBetween('date', array($date1, $date2))
                           ->orderBy('date', 'desc')
                           ->get();

		return view('transfers.index', compact('date1', 'date2', 'transfers', 'no'));
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
                     'downline' => $value->tujuan,
                     'date' => date('Y-m-d', strtotime($value->tanggal)),
                     'nominal' => $value->deposit,
                     'status' => $value->status,
                     'user_id' => Auth::user()->id,
                  ];
   				}
               // dd($inserts);
   				if(!empty($inserts)){
   					DB::table('transfers')->insert($inserts);
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
      $data = Transfer::select('downline', 'nominal', 'date')
                     ->where('user_id', Auth::user()->id)
                     ->whereBetween('date', array($date1, $date2))
                     ->orderBy('date', 'asc')
                     ->get()
                     ->toArray();

		return Excel::create('transfer', function($excel) use ($data) {
			$excel->sheet('transfer sheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}

   public function exportToPdf($date1, $date2)
   {
      $transfers = Transfer::where('user_id', Auth::user()->id)
                           ->whereBetween('date', array($date1, $date2))
                           ->orderBy('date', 'desc')
                           ->get();

      $html = view('transfers.indexPdf', compact('transfers', 'date1', 'date2'))->render();

      return $this->pdf
           ->load($html, 'A4', 'landscape')
           ->show();
   }

   public function destroy($id)
   {
      $transfer = Transfer::findOrFail($id);

      if($transfer->isOwner()){
         $transfer->delete();
      }else{
         return back()->with('warning', 'You can not delete this data.');
      }

      return back()->with('success', 'Data Deleted');
   }

   public function multipleDestroy(Request $request)
   {
      // cek apakah datanya kosong atau ngga
      if ($request->transfers != null) {
         // melakukan delete dengan looping
         foreach ($request->transfers as $data) {
            $transfer = Transfer::where('id', $data)
                                       ->where('user_id', Auth::user()->id)
                                       ->first();
            $transfer->delete();
         }
         return back()->with('success', 'Data Deleted');

      }else {
         return back()->with('warning', 'Please select data.');
      }
   }

   public function store(Request $request)
   {
      $this->validate($request, [
         'downline'      => 'required',
         'nominal'   => 'required',
         'date'      => 'required',
      ]);

      $transfer = Transfer::create([
         'downline'  => $request->downline,
         'date'      => $request->date,
         'nominal'   => $request->nominal,
         'user_id'   => Auth::user()->id,
      ]);

      return back()->with('success', 'Data saved');
   }
}
