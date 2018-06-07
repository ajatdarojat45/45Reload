@extends('layouts.header')
@section('title')
   Log
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
		<b style="color:#808080">/Log</b>
	</center>
   <br>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="tabs-container">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#deposit"> Log</a></li>
					<li class=""><a data-toggle="tab" href="#graph"> Graph</a></li>
				</ul>
				<div class="tab-content">
					{{-- Deposit --}}
					<div id="deposit" class="tab-pane active">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-6 col-lg-6">
   								 <label for="formGroupExampleInput">Search :</label>
									 <form class="" action="{{route('log/index')}}" method="get">
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
									<button type="button" style="margin-left:5px;" class="btn btn-danger btn-sm pull-right" data-toggle="tooltip" title="Export ke PDF" onclick="window.open('{{ route('transaction/exportToPdf', ['date1' => date('y-m-d', strtotime($date1)), 'date2' => date('y-m-d', strtotime($date2)), 'wallet' => 'a', 'category' => 'a']) }}', '_blank');">
										<i class="fa fa-file-pdf-o"></i> PDF
									</button>
									<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="tooltip" title="Export ke PDF" onclick="window.open('{{ route('transaction/exportToExcel', ['date1' => date('y-m-d', strtotime($date1)), 'date2' => date('y-m-d', strtotime($date2)), 'type' => 'xlsx', 'wallet' => 'a', 'category' => 'a']) }}', '_blank');">
										<i class="fa fa-file-excel-o"></i> Excel
									</button>
								</div>
							</div>
							<br>
							<div class="table-responsive">
                        <form class="" action="{{route('transaction/multipleDestroy')}}" method="post">
   								<table id="example1" class="table table-hover table-striped">
   									 <thead>
   										  <tr>
   												<th style="text-align: center;">No</th>
                                       <th style="text-align: center;">User</th>
                                       <th style="text-align: center;">Country Code</th>
                                       <th style="text-align: center;">Country Name</th>
   												<th style="text-align: center;">Region Code</th>
   												<th style="text-align: center;">Region Name</th>
   												<th style="text-align: center;">City Name</th>
   												<th style="text-align: center;">Zip Code</th>
   												<th style="text-align: center;">Postal Code</th>
                                       <th style="text-align: center;">Latitude</th>
                                       <th style="text-align: center;">Longitude</th>
                                       <th style="text-align: center;">Created at</th>
   										  </tr>
   									 </thead>
   									 <tbody>
                                  @foreach ($logs as $log)
                                     <tr>
                                        <td class="text-center">{{++$no}}</td>
                                        <td class="text-center">{{$log->user->name}}</td>
                                        <td class="text-center">{{$log->country_code}}</td>
                                        <td>{{$log->country_name}}</td>
                                        <td class="text-center">{{$log->region_code}}</td>
                                        <td>{{$log->region_name}}</td>
                                        <td>{{$log->city_name}}</td>
                                        <td class="text-center">{{$log->zip_code}}</td>
                                        <td class="text-center">{{$log->postal_code}}</td>
                                        <td class="text-right">{{$log->latitude}}</td>
                                        <td class="text-right">{{$log->longitude}}</td>
                                        <td class="text-center">{{$log->created_at->format('d M. Y h:i:s')}}</td>
                                     </tr>
                                  @endforeach
   									 </tbody>
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
								{!! Charts::database($logs, 'line', 'highcharts')
                                 ->setTitle('Log Graph')
                               	->setElementLabel("Log Data")
                               	->setDimensions(1000, 500)
                               	->setResponsive(false)
                               	->groupByDay()
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
@endsection
