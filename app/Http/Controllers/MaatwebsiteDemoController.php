<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Input;

use Input;
use App\Item;
use DB;
use Excel;
use App\Deposit;

class MaatwebsiteDemoController extends Controller
{
	public function importExport()
	{
		return view('importExport');
	}
	public function downloadExcel($type)
	{
		$data = Item::get()->toArray();
		return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
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
					dd('Insert Record successfully.');
				}
			}
		}
		return back();
	}
}
