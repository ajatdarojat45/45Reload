<!DOCTYPE html>
<html>
   {{-- <head> --}}
      <title>Transfer Report - 45 Reload</title>
      <link href="{{ asset('inspinia/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('inspinia/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
   {{-- </head> --}}
   <body>
      <div style="font-size: 13px; text-align: right; color:#5E5B5C">
         <i>Print date
         {{ date("d/m/Y H:i:s") }} by {{ Auth::user()->name }}
         </i>
      </div>
      <div style="color: #5E5B5C">
         <center><b style="text-transform: uppercase; color:#5E5B5C;"><h4>Transfer Report</h4></b></center><br>
         <p>From <b><i>{{date('d M. Y', strtotime($date1))}}</i></b> to <b><i>{{date('d M. Y', strtotime($date2))}}</i></b></p>
         <table id="example1" class="table table-hover table-striped">
             <thead>
                 <tr>
                     <th style="text-align: center;">No</th>
                     <th style="text-align: center;">Downline</th>
                     <th style="text-align: center;">Nominal</th>
                     <th style="text-align: center;">Status</th>
                     <th style="text-align: center;">Date</th>
                 </tr>
             </thead>
             <tbody>
                @php
                  $no = 0;
                  $total = 0;
                @endphp
                @foreach ($transfers as $transfer)
                   <tr>
                      <td class="text-center">{{++$no}}</td>
                      <td class="text-left">{{$transfer->downline}}</td>
                      <td class="text-right">{{GlobalHelper::f_currency($transfer->nominal)}}</td>
                      <td class="text-center">{{$transfer->status}}</td>
                      <td class="text-center">{{date('d M. Y', strtotime($transfer->date))}}</td>
                   </tr>
                   @php
                     $total = $total + $transfer->nominal;
                   @endphp
                @endforeach
             </tbody>
             <tfoot>
               <tr>
                  <th colspan="2"class="text-center">Total</th>
                  <th class="text-right">{{GlobalHelper::f_currency($total)}}</th>
                  <th colspan="2"></th>
               </tr>
             </tfoot>
         </table>
      </div>
   </body>
</html>
