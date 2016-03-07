@extends('settings.accounts.headings')

@section('content')
	<div class="container">
		<h2 class="header">Criar nova conta</h2>
		<div class="section">
			<p>Indique abaixo o nome que pretende atribuir à sua conta e o saldo respetivo na data escolhida.</p>

			@include('partials.errors')

			{!! Form::open(['url' => action('AccountController@store')]) !!}
			@include('settings.accounts._form')
			{!! Form::submit('Criar', ['class' => 'btn waves-effect waves-light cyan']) !!}
			{!! Form::close() !!}
		</div>
	</div>
@endsection