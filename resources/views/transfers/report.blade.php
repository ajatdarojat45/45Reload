@extends('layouts.header')
@section('title')
   Transfer Report by Date
@endsection

@section('content')
<div class="container">
   <div class="text-center">
      <a href="{{route('dashboard')}}" style="color:#636b6f">/Dashboard</a>
      <a href="{{route('transfer/index')}}" style="color:#636b6f">/Transfer</a>
      <b style="color:#636b6f">/Report</b>
   </div>
   <div class="row" style="display:flex">
      <div class="col-lg-12 col-md-12">
         <div class="tabs-container">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#deposit"> Report</a></li>
				</ul>
				<div class="tab-content">
               <div id="deposit" class="tab-pane active">
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-lg-6 col-md-6">
                           <label for="formGroupExampleInput">Search :</label>
									<form class="" action="{{route('transfer/report')}}" method="get">
                              <div class="input-group" style="margin-bottom:5px;">
                                  <span class="input-group-addon"><i class="fa fa-exchange"></i> Report Type</span>
                                  <select name="type" style="height:32px" class="form-control" required="required">
                                      <option value="">-- Please select type --</option>
                                      <option value="date" @if ($type == 'date') selected @endif>Date</option>
                                     <option value="month" @if ($type == 'month') selected @endif>Month</option>
                                     <option value="year" @if ($type == 'year') selected @endif>Year</option>
                                  </select>
                               </div>
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
                     </div>
                     <div class="row">
                        <div class="col-lg-12 col-md-12">
                           <div class="text-center table-responsive">
      								{!! Charts::create('bar', 'highcharts')
      											->setTitle('Deposit Graph')
                                       ->setElementLabel("Nominal (Rp.)")
      											->setLabels($data['labels'])
      											->setValues($data['values'])
      											->setDimensions(1000,500)
      											->setResponsive(false)->render();
      								!!}
      							</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
