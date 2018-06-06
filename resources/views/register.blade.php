<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Register - konterPulsa</title>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> {{-- bootstrap --}}
        <link href="{{asset('bootstrap-3/css/bootstrap.min.css')}}" rel="stylesheet"> {{-- dataTables --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <link href="{{ asset('inspinia/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content" >
               <div class="row">
                 <div class="col-lg-12 col-md-12">
                    <div style="border: 1px solid #a1a1a1; margin-top: 15px; padding: 30px;">
                       <h2>konterPulsa</h2>
                       <p><b>Please Register</b> </p>
                       <form method="POST" action="{{ route('register') }}">
                           @csrf

                           <div class="form-group row">
                               <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                               <div class="col-md-8">
                                   <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                   @if ($errors->has('name'))
                                       <span class="invalid-feedback">
                                           <strong>{{ $errors->first('name') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group row">
                               <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                               <div class="col-md-8">
                                   <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                   @if ($errors->has('email'))
                                       <span class="invalid-feedback">
                                           <strong>{{ $errors->first('email') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group row">
                               <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                               <div class="col-md-8">
                                   <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                   @if ($errors->has('password'))
                                       <span class="invalid-feedback">
                                           <strong>{{ $errors->first('password') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group row">
                               <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                               <div class="col-md-8">
                                   <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                               </div>
                           </div>

                           <div class="form-group row mb-0">
                               <div class="col-md-12 offset-md-4">
                                   <button type="submit" class="btn btn-primary">
                                       {{ __('Register') }}
                                   </button>
                               </div>
                           </div>
                           <b>Have a account ?</b>
                           <a class="btn btn-link" href="{{ route('login') }}">
                              Login here
                           </a>
                       </form>
                    </div>
                 </div>
               </div>
               <br>
               <b><a href="https://ajatdarojat45.id" target="_blank" style="color:#636b6f;">lazyCode</a> - <i class="fa fa-code"></i> dengan <i class="fa fa-heart" style="color:red"></i> </b>
            </div>
        </div>
    </body>
</html>
