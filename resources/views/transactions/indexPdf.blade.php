<!DOCTYPE html>
<html>
   {{-- <head> --}}
      <title>Transaction Report - 45 Reload</title>
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
         <center><b style="text-transform: uppercase; color:#5E5B5C;"><h4>Transaction Report</h4></b></center><br>
         <p>From <b><i>{{date('d M. Y', strtotime($date1))}}</i></b> to <b><i>{{date('d M. Y', strtotime($date2))}}</i></b></p>
         <table id="example1" class="table table-hover table-striped">
             <thead>
                 <tr>
                     <th style="text-align: center;">No</th>
                     <th style="text-align: center;">Costumer</th>
                     <th style="text-align: center;">Distributor Price</th>
                     <th style="text-align: center;">Sell Price</th>
                     <th style="text-align: center;">Profit</th>
                     {{-- <th style="text-align: center;">Status</th> --}}
                     <th style="text-align: center;">Date</th>
                 </tr>
             </thead>
             <tbody>
                @php
                  $no = 0;
                  $distributorPriceTotal = 0;
                  $sellPriceTotal = 0;
                  $profitTotal = 0;
                @endphp
                @foreach ($transactions as $transaction)
                   <tr>
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
                   </tr>
                   @php
                     $distributorPriceTotal = $distributorPriceTotal + $transaction->distributor_price;
                     $sellPriceTotal = $sellPriceTotal + $transaction->sell_price;
                     $profitTotal = $profitTotal + $transaction->profit;
                   @endphp
                @endforeach
             </tbody>
             <tfoot>
               <tr>
                  <th colspan="2"class="text-center">Total</th>
                  <th class="text-right">{{GlobalHelper::f_currency($distributorPriceTotal)}}</th>
                  <th class="text-right">{{GlobalHelper::f_currency($sellPriceTotal)}}</th>
                  <th class="text-right">{{GlobalHelper::f_currency($profitTotal)}}</th>
                  <th colspan=""></th>
               </tr>
             </tfoot>
         </table>
      </div>
   </body>
</html>
