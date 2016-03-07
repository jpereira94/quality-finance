@extends('settings.companies.headings')

@section('content')
	<div class="container">
		<h2 class="header">Criar nova entidade</h2>
		<div class="section">
			@include('partials.errors')
			{!! Form::open(['url' => action('CompanyController@store')]) !!}
			@include('settings.companies._form')
			{!! Form::submit('Criar', ['class' => 'btn waves-effect waves-light cyan']) !!}
			{!! Form::close() !!}
		</div>
	</div>
@endsection