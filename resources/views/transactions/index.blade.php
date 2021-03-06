@extends('layouts.header')
@section('title')
   Transaction
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
		<b style="color:#808080">/Transaction</b>
	</center>
	{{-- form --}}
	<form style="border: 1px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('transaction/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<label for="">Import your file here (.xsl & .xslx) :</label>
		<div class="row">
		  <div class="col-lg-3 col-md-3">
			  <input type="file" name="import_file" />
		  </div>
		  <button class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> Import File</button>
		</div>
	</form>
	{{-- form --}}
	<br>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="tabs-container">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#deposit"> Transaction</a></li>
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
									 <form class="" action="{{route('transaction/index')}}" method="get">
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
									<label for="formGroupExampleInput" class="pull-right">Export to :</label><br><br>
									<button type="button" style="margin-left:5px;" class="btn btn-danger btn-sm pull-right" data-toggle="tooltip" title="Export ke PDF" onclick="window.open('{{ route('transaction/exportToPdf', ['date1' => date('y-m-d', strtotime($date1)), 'date2' => date('y-m-d', strtotime($date2))]) }}', '_blank');">
										<i class="fa fa-file-pdf-o"></i> PDF
									</button>
									<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="tooltip" title="Export ke PDF" onclick="window.open('{{ route('transaction/exportToExcel', ['date1' => date('y-m-d', strtotime($date1)), 'date2' => date('y-m-d', strtotime($date2)), 'type' => 'xlsx']) }}', '_blank');">
										<i class="fa fa-file-excel-o"></i> Excel
									</button>
								</div>
							</div>
							<br>
							<div class="table-responsive">
                        <form class="" action="{{route('transaction/multipleDestroy')}}" method="post">
                           {{csrf_field()}}
                           <table id="example1" class="table table-hover table-striped">
                              <thead>
                                 <tr>
                                    <th style="text-align: center;"></th>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Costumer</th>
                                    <th style="text-align: center;">Distributor Price</th>
                                    <th style="text-align: center;">Sell Price</th>
                                    <th style="text-align: center;">Profit</th>
                                    {{-- <th style="text-align: center;">Status</th> --}}
                                    <th style="text-align: center;">Date</th>
                                    <th style="text-align: center;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @php
                                 if (!empty($transactions)) {
                                    $labels[] = 'Start';
                                    $distributorValues[] = 0;
                                    $sellValues[] = 0;
                                    $profitValues[] = 0;
                                 }
                                 $distributorPriceTotal = 0;
                                 $sellPriceTotal = 0;
                                 $profitTotal = 0;
                                 @endphp
                                 @foreach ($transactions as $transaction)
                                    <tr>
                                       <td class="text-center">
                                          <input type="checkbox" name="transactions[]" value="{{$transaction->id}}">
                                       </td>
                                       <td class="text-center">{{++$no}}</td>
                                       <td class="text-left">{{$transaction->customer}}</td>
                                       <td class="text-right">
                                          {{GlobalHelper::f_currency($transaction->distributor_price)}}
                                       </td>
                                       <td class="text-right">
                                          {{GlobalHelper::f_currency($transaction->sell_price)}}
                                       </td>
                                       <td class="text-right">
                                          {{GlobalHelper::f_currency($transaction->profit)}}
                                       </td>
                                       {{-- <td class="text-center">{{$transaction->status}}</td> --}}
                                       <td class="text-center">{{date('d M. Y', strtotime($transaction->date))}}</td>
                                       <td class="text-center">
                                          <a href="{{route('transaction/destroy', $transaction->id)}}" class="btn btn-danger btn-sm confirm"><i class="fa fa-trash"></i> </a>
                                       </td>
                                    </tr>
                                    @php
                                    $distributorPriceTotal = $distributorPriceTotal + $transaction->distributor_price;
                                    $sellPriceTotal = $sellPriceTotal + $transaction->sell_price;
                                    $profitTotal = $profitTotal + $transaction->profit;
                                    $labels[] = date('d M. Y', strtotime($transaction->date));
                                    $distributorValues[] = $transaction->distributor_price;
                                    $sellValues[] = $transaction->sell_price;
                                    $profitValues[] = $transaction->profit;
                                 @endphp
                              @endforeach
                           </tbody>
                           <tfoot>
                              <tr>
                                 <th colspan="3"class="text-center">Total</th>
                                 <th class="text-right">{{GlobalHelper::f_currency($distributorPriceTotal)}}</th>
                                 <th class="text-right">{{GlobalHelper::f_currency($sellPriceTotal)}}</th>
                                 <th class="text-right">{{GlobalHelper::f_currency($profitTotal)}}</th>
                                 <th colspan="2"></th>
                              </tr>
                              <tr>
                                 <th colspan="8">
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
								{!! Charts::multi('bar', 'highcharts')
									->setTitle('Transaction Graph')
									->setColors(['#ff0000', '#0000ff', '#00ff00'])
									->setLabels($labels)
									->setDataset('Distributor Price', $distributorValues)
									->setDataset('Sell Price', $sellValues)
									->setDataset('Profit', $profitValues)
									->setDimensions(1000,500)
									->setResponsive(false)
									->render();
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
      <form class="" action="{{route('transaction/store')}}" method="post">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id=""></h4>
            </div>
            <div class="modal-body">
               <fieldset class="form-horizontal">
                  <div class="form-group">
                     <label class="col-lg-3 col-md-3 control-label">Customer</label>
                     <div class="col-lg-9 col-md-9">
                        @if ($errors->has('customer'))
                           <span class="help-block">
                              <strong style="color: red">{{ $errors->first('customer') }}</strong>
                           </span>
                        @endif
                        <input type="text" class="form-control" name="customer" value="{{ old('customer') }}">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 col-md-3 control-label">Distributor Price</label>
                     <div class="col-lg-9 col-md-9">
                        @if ($errors->has('distributor_price'))
                           <span class="help-block">
                              <strong style="color: red">{{ $errors->first('distributor_price') }}</strong>
                           </span>
                        @endif
                        <input type="number" class="form-control" name="distributor_price" value="{{ old('distributor_price') }}">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 col-md- control-label">Sell Price</label>
                     <div class="col-lg-9 col-md-9">
                        @if ($errors->has('sell_price'))
                           <span class="help-block">
                              <strong style="color: red">{{ $errors->first('sell_price') }}</strong>
                           </span>
                        @endif
                        <input type="number" class="form-control" name="sell_price" value="{{ old('sell_price') }}">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 col-md-3 control-label">Date</label>
                     <div class="col-lg-9 col-md-9">
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
