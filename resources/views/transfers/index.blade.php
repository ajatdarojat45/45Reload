@extends('layouts.header')
@section('title')
   Transfer
@endsection
@section('content')
<div class="container">
	@if (session('success'))
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Success!</strong> {{session('success') }}
	</div>
	@endif
	@if (session('warning'))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Success!</strong> {{session('warning') }}
	</div>
	@endif
	<center>
		<a href="{{route('dashboard')}}" style="color:#808080">/Dashboard</a>
		<b style="color:#808080">/Transfer</b>
	</center>
	{{-- form --}}
	<form style="border: 1px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('transfer/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<label for="">Import your file here (.xls & .xlsx) :</label>
		<div class="row">
		  <div class="col-lg-3 col-md-3">
			  <input type="file" name="import_file" />
		  </div>
		  <button class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> Import File</button>
		</div>
	</form>
	<br>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="tabs-container">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#deposit"> Transfer</a></li>
					<li class=""><a data-toggle="tab" href="#graph"> Graph</a></li>
				</ul>
				<div class="tab-content">
					{{-- Deposit --}}
					<div id="deposit" class="tab-pane active">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-6 col-lg-6">
                           <a href="#myModal" class="btn btn-primary btn-sm" data-toggle="modal">
                              <i class="fa fa-plus-circle"></i> Add
                           </a>
                           <br><br>
   								 <label for="formGroupExampleInput">Search :</label>
									 <form class="" action="{{route('transfer/index')}}" method="get">
										 <div class="input-group">
											 <div class="" id="data_1">
												 <div class="input-group date">
													 <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="{{$date1}}" name="date1">
												 </div>
											 </div>
											 <div class="input-group-addon"><b>to</b></div>
											 <div class="" id="data_1_1">
												 <div class="input-group date">
													 <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													 <input type="text" class="form-control" value="{{$date2}}" name="date2">
												 </div>
											 </div>
											 <span class="input-group-btn">
												 <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Cari">
													 <i class="fa fa-search"></i> Search
												 </button>
											 </span>
										 </div>
									 </form>
   							</div>
								<div class="col-md-6 col-lg-6">
									<label class="pull-right">Export to :</label><br><br>
									<button type="button" style="margin-left:5px;" class="btn btn-danger btn-sm pull-right" data-toggle="tooltip" title="Export ke PDF" onclick="window.open('{{ route('transfer/exportToPdf', ['date1' => date('y-m-d', strtotime($date1)), 'date2' => date('y-m-d', strtotime($date2))]) }}', '_blank');">
										<i class="fa fa-file-pdf-o"></i> PDF
									</button>
									<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="tooltip" title="Export ke Excel" onclick="window.open('{{ route('transfer/exportToExcel', ['date1' => date('y-m-d', strtotime($date1)), 'date2' => date('y-m-d', strtotime($date2)), 'type' => 'xlsx']) }}', '_blank');">
										<i class="fa fa-file-excel-o"></i> Excel
									</button>
								</div>
							</div>
							<br>
							<div class="table-responsive">
                        <form action="{{route('transfer/multipleDestroy')}}" method="post">
                           {{csrf_field()}}
                           <table id="example1" class="table table-hover table-striped">
                              <thead>
                                 <tr>
                                    <th style="text-align: center;"></th>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Downline</th>
                                    <th style="text-align: center;">Nominal</th>
                                    {{-- <th style="text-align: center;">Status</th> --}}
                                    <th style="text-align: center;">Date</th>
                                    <th style="text-align: center;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @php
                                 $total = 0;
                                 $labels[] = 'Start';
                                 $values[] = 0;
                                 @endphp
                                 @foreach ($transfers as $transfer)
                                    <tr>
                                       <td class="text-center">
                                          <input type="checkbox" name="transfers[]" value="{{$transfer->id}}">
                                       </td>
                                       <td class="text-center">{{++$no}}</td>
                                       <td class="text-left">{{$transfer->downline}}</td>
                                       <td class="text-right">{{GlobalHelper::f_currency($transfer->nominal)}}</td>
                                       {{-- <td class="text-center">{{$transfer->status}}</td> --}}
                                       <td class="text-center">{{date('d M. Y', strtotime($transfer->date))}}</td>
                                       <td class="text-center">
                                          <a href="{{route('transfer/destroy', $transfer->id)}}" class="btn btn-danger btn-sm confirm">
                                             <i class="fa fa-trash"></i>
                                          </a>
                                       </td>
                                    </tr>
                                    @php
                                    $total = $total + $transfer->nominal;
                                    $labels[] = date('d M. Y', strtotime($transfer->date));
                                    $values[] = $transfer->nominal;
                                    // dd($labels);
                                    @endphp
                                 @endforeach
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <th colspan="3"class="text-center">Total</th>
                                    <th class="text-right">{{GlobalHelper::f_currency($total)}}</th>
                                    <th colspan="2"></th>
                                 </tr>
                                 <tr>
                                    <th colspan="6">
                                       <button type="submit" class="btn btn-danger btn-sm btn-block" onclick="javasciprt: return confirm('Are you sure, to delete data?')">
                                          <i class="fa fa-trash"></i> Delete
                                       </button>
                                    </th>
                                 </tr>
                              </tfoot>
                           </table>
                        </form>
							</div>
						</div>
					</div>
					{{-- depositr --}}
					{{-- graph --}}
					<div id="graph" class="tab-pane">
						<div class="panel-body">
							<div class="text-center table-responsive">
								{!! Charts::create('bar', 'highcharts')
											->setTitle('Deposit Graph')
											->setLabels($labels)
											->setValues($values)
											->setDimensions(1000,500)
											->setResponsive(false)->render();
								!!}
							</div>
						</div>
					</div>
					{{-- graph --}}
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
   <div class="modal-dialog">
      <form class="" action="{{route('transfer/store')}}" method="post">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id=""></h4>
            </div>
            <div class="modal-body">
               <fieldset class="form-horizontal">
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Downline</label>
                     <div class="col-sm-10">
                        @if ($errors->has('downline'))
                           <span class="help-block">
                              <strong style="color: red">{{ $errors->first('downline') }}</strong>
                           </span>
                        @endif
                        <input type="text" class="form-control" name="downline" value="{{ old('downline') }}">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Nominal</label>
                     <div class="col-sm-10">
                        @if ($errors->has('nominal'))
                           <span class="help-block">
                              <strong style="color: red">{{ $errors->first('nominal') }}</strong>
                           </span>
                        @endif
                        <input type="number" class="form-control" name="nominal" value="{{ old('nominal') }}">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Date</label>
                     <div class="col-sm-10">
                        @if ($errors->has('date'))
                           <span class="help-block">
                              <strong style="color: red">{{ $errors->first('date') }}</strong>
                           </span>
                        @endif
                        <div class="" id="data_1">
                           @if ($errors->has('start'))
                              <span class="help-block">
                                 <strong style="color: red"></strong>
                              </span>
                           @endif
                           <div class="input-group date">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="{{ old('date') }}" name="date">
                           </div>
                        </div>
                     </div>
                  </div>
                  {{csrf_field()}}
               </fieldset>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
               <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save</button>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection
