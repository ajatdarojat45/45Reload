<!DOCTYPE html>
<html>
   {{-- <head> --}}
      <title>Deposit Report - 45 Reload</title>
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
         <center><b style="text-transform: uppercase; color:#5E5B5C;"><h4>Deposit Report</h4></b></center><br>
         <p>From <b><i>{{date('d M. Y', strtotime($date1))}}</i></b> to <b><i>{{date('d M. Y', strtotime($date2))}}</i></b></p>
         <table id="example1" class="table table-hover table-striped">
             <thead>
                 <tr>
                     <th style="text-align: center;">No</th>
                     <th style="text-align: center;">Bank</th>
                     <th style="text-align: center;">Nominal</th>
                     <th style="text-align: center;">Date</th>
                 </tr>
             </thead>
             <tbody>
                @php
                  $total = 0;
                  $no = 0;
                @endphp
                @foreach ($deposits as $deposit)
                   <tr>
                      <td class="text-center">{{++$no}}</td>
                      <td class="text-center">{{$deposit->bank}}</td>
                      <td class="text-right">{{GlobalHelper::f_currency($deposit->nominal)}}</td>
                      <td class="text-center">{{date('d M. Y', strtotime($deposit->date))}}</td>
                   </tr>
                   @php
                     $total = $total + $deposit->nominal;
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
