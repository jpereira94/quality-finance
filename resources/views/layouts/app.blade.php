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

	<!-- Styles -->
	<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>

@include('partials.side-nav')

<main>
	{{--cyan lighten-2--}}
	<nav class="top-nav navbar-fixed-top">
		<div class="container">
			<div class="nav-wrapper">
				<a href="@yield('page-title-link', '#!')" class="page-title">@yield('page-title', 'Quality Contabilidade')</a>

				@yield('top-nav')
				<!--<ul class="right">
					<li>
						<a href="#!">
							<i class="material-icons">note_add</i>
						</a>
					</li>
					<li>
						<a href="#!">
							Components
						</a>
					</li>
				</ul>-->
			</div>
		</div>
	</nav>

	<!-- <div class="container"> -->

		@yield('content')

		{{--<h2 class="header">
			Material Design
		</h2>--}}

		{{--<span class="fa-stack">
                <i class="fa fa-plus fa-stack-1x"></i>
                <i class="fa fa-file-o fa-stack-2x"></i>
			</span>
		<i class="material-icons">note_add</i>
		<i class="material-icons">library_add</i>

		<i class="fa fa-plus-square"></i>


		<!--  Material Design -->
		<div class="section scrollspy" id="materialdesign">
			<p class="caption">Created and designed by Google, Material Design is a design language that combines the classic principles of successful design
				along with innovation and technology. Google's goal is to develop a system of design that allows for a unified user experience
				across all their products on any platform.</p>
			<div class="video-container">
				<iframe width="853" height="480" frameborder="0" allowfullscreen="" src="//www.youtube.com/embed/Q8TXgCzxEnw?rel=0"></iframe>
			</div>

			<div class="row section">
				<h3 class="header light">Principles</h3>
				<div class="col s12 l4">
					<img src="images/metaphor.png" class="promo">
					<h4 class="center">Material is the metaphor</h4>
					<p class="light">The metaphor of material defines the relationship between space and motion. The idea is that the technology is inspired by paper and ink and is utilized to facilitate creativity and innovation. Surfaces and edges provide familiar visual cues that allow users to quickly understand the technology beyond the physical world.</p>
					<br>
				</div>

				<div class="col s12 l4">
					<img src="images/bold.png" class="promo">
					<h4 class="center">Bold, graphic, intentional</h4>
					<p class="light">Elements and components such as grids, typography, color, and imagery are not only visually pleasing, but also create a sense of hierarchy, meaning, and focus. Emphasis on different actions and components create a visual guide for users.</p>
					<br>
				</div>

				<div class="col s12 l4">
					<img src="images/motion.png" class="promo">
					<h4 class="center">Motion provides meaning</h4>
					<p class="light">Motion allows the user to draw a parallel between what they see on the screen and in real life. By providing both feedback and familiarity, this allows the user to fully immerse him or herself into unfamiliar technology. Motion contains consistency and continuity in addition to giving users additional subconscious information about objects and transformations.</p>
				</div>
			</div>
		</div>--}}

	<!-- </div> -->

	<!-- Modal Trigger -->
	<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>
	<!-- Modal Structure -->
	<div id="modal1" class="modal right-sheet">
		<!--<div class="modal-content">
            <h4>Modal Header</h4>
            <p>A bunch of text</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
        </div>-->
	</div>

</main>



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
