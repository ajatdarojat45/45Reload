<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - 45 Reload</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> {{-- bootstrap --}}
    <link href="{{asset('bootstrap-3/css/bootstrap.min.css')}}" rel="stylesheet"> {{-- dataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link href="{{ asset('inspinia/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    {!! Charts::assets() !!}
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    45 Reload
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    @guest
                    @else
                       <li><a class="nav-link" href="{{ route('deposit/index') }}">Deposit</a></li>
                       <li><a class="nav-link" href="{{ route('transaction/index') }}" style="margin-left:10px;">Transaction</a></li>
                       <li><a class="nav-link" href="{{ route('transfer/index') }}" style="margin-left:10px;">Transfer</a></li>
                       <li class="nav-item dropdown" style="margin-left:10px;">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                             Report
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                             <a class="dropdown-item" href"#">Deposit</a>
                             <a class="dropdown-item" href"#">Transaction</a>
                             <a class="dropdown-item" href"#">Transfer</a>
                          </div>
                       </li>
                    @endguest
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto pull-right">
                        <!-- Authentication Links -->
                        @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('bootstrap-3/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <!-- Data picker -->
   <script src="{{ asset('inspinia/js/plugins/datapicker/bootstrap-datepicker.js') }} "></script>
   <!-- Date range picker -->
   <script src="{{ asset('inspinia/js/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example1').DataTable();
        });
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
         $('#rate').modal('show');
      });
      $('#data_1 .input-group.date').datepicker({
         todayBtn: "linked",
         keyboardNavigation: false,
         forceParse: false,
         calendarWeeks: true,
         autoclose: true,
         format: "yyyy/mm/dd"
      });
      $('#data_1_1 .input-group.date').datepicker({
         todayBtn: "linked",
         keyboardNavigation: false,
         forceParse: false,
         calendarWeeks: true,
         autoclose: true,
         format: "yyyy/mm/dd"
      });
      $('#data_2 .input-group.date').datepicker({
         startView: 1,
         todayBtn: "linked",
         keyboardNavigation: false,
         forceParse: false,
         autoclose: true,
         format: "mm/dd/yyyy"
      });
      $('#data_3 .input-group.date').datepicker({
         startView: 2,
         todayBtn: "linked",
         keyboardNavigation: false,
         forceParse: false,
         autoclose: true
      });
      $('#data_4 .input-group.date').datepicker({
         minViewMode: 1,
         keyboardNavigation: false,
         forceParse: false,
         forceParse: false,
         autoclose: true,
         todayHighlight: true
      });
      $('#data_5 .input-daterange').datepicker({
         keyboardNavigation: false,
         forceParse: false,
         autoclose: true
      });
   </script>
</body>

</html>
