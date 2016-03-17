<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Contabilidade Quality</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'> -->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eceff1 ;
        }

        .form-signin {
            width: 482px;
            padding: 15px;
            margin: 0 auto;
        }
        /*.form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin .checkbox {
            font-weight: normal;
        }
        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }*/
    </style>
</head>
<body>

    <div class="form-signin-header blue-grey darken-3" style="height: 270px; margin-top: -40px"></div>
    <div class="form-signin" style="margin-top: -230px">
        <p class="logo center-align white-text text-uppercase">
            <span style="color: rgba(255, 255, 255, 0.45); font-size: 4rem; line-height: 1.1;">Quality</span>
            <span style="display: block; font-size: 2.8rem">Contabilidade</span>
        </p>
        <!--<h2 class="form-signin-heading">Efetue o login</h2>-->



        {!! Form::open(['id' => 'login-form', 'method' => 'POST', 'url' => url('/login'), 'style' => 'background-color:#FFF; padding: 44px 65px', 'class' => 'z-depth-2']) !!}

        <p style="font-weight: 700; font-size: 1.5rem; margin: 0 0 40px;" class="text-uppercase">
            Entrar
            <a href="#!" onclick="$('#login-form').submit()" class="right text-uppercase" style="font-size: 15px; font-weight: normal; line-height: 2.25; color: rgba(0, 0, 0, 0.54);">Seguinte <i class="mdi-navigation-chevron-right mdi-lg"></i></a>
        </p>

        <div class="input-field" style="margin:0 0 20px">
            {!! Form::text('username', old('username')) !!}
            {!! Form::label('username', 'Utilizador', ['style' => 'left: 0']) !!}
        </div>

        <div class="input-field" style="margin:0 0 20px">
            {!! Form::password('password') !!}
            {!! Form::label('password', 'Password', ['style' => 'left: 0']) !!}
        </div>

        {{--{!! Form::submit('Entrar', ['class' => 'btn']) !!}--}}

        {!! Form::close() !!}

        @if (count($errors) > 0)
            <div class="card-panel red white-text z-depth-2" style="margin-top: 25px">
                <ul class="no-margin">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}


            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i>Login
                    </button>

                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                </div>
            </div>
        </form>--}}

        {{--<label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>--}}
    </div>

{{--<footer class="page-footer">
	<div class="footer-copyright">
		<div class="container">

			<a class="grey-text text-lighten-4 right" href="#!">
				<i class="material-icons">save</i>
			</a>
		</div>
	</div>
</footer>--}}


        <!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="http://momentjs.com/downloads/moment-with-locales.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
<script src="{{ asset('js/materialize.js') }}"></script>

</body>
</html>


@section('content')

@endsection
