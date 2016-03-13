<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laravel</title>

	<!-- Fonts -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'> -->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>

	<!-- Styles -->
	<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>

<div class="alert orange center-align">
	Para submeter formulários deve carregar obrigatoriamente no <strong>texto</strong> Criar ou Editar.
</div>

@include('partials.side-nav')

<main>
	{{--cyan lighten-2--}}
	<nav class="top-nav navbar-fixed-top">
		<div class="container">
			<div class="nav-wrapper">
				<a href="@yield('page-title-link', '#!')" class="page-title">@yield('page-title', 'Quality Contabilidade')</a>
				@yield('top-nav')
			</div>
		</div>
	</nav>
	@yield('content')
</main>

@yield('footer')

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
<script>
	$('.collapsible').collapsible({
		hover: true
	});
	jQuery.extend( jQuery.fn.pickadate.defaults, {
		monthsFull: [ 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro' ],
		monthsShort: [ 'jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez' ],
		weekdaysFull: [ 'Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado' ],
		weekdaysShort: [ 'dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab' ],
		weekdaysLetter: [ 'D', 'S', 'T', 'Q', 'Q', 'S', 'S' ],
		today: 'Hoje',
		clear: 'Limpar',
		close: 'Fechar',
		format: 'd !de mmmm !de yyyy',
		formatSubmit: 'yyyy-mm-dd'
	});
	$('.datepicker').pickadate({
		firstDay: true,
		closeOnSelect: true,
		closeOnClear: true,
	});

	$(document).ready(function(){
		// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
		$('.modal-trigger').leanModal();
		$('select').material_select();
	});

</script>
@yield('js')
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
