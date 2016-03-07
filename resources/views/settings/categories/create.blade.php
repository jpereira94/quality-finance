@extends('settings.categories.headings')

@section('content')
	<div class="container">
		<h2 class="header">Criar nova categoria</h2>
		<div class="section">
			@include('partials.errors')
			{!! Form::open(['url' => action('CategoryController@store')]) !!}
			@include('settings.categories._form')
			{!! Form::submit('Criar', ['class' => 'btn waves-effect waves-light cyan']) !!}
			{!! Form::close() !!}
		</div>
	</div>
@endsection