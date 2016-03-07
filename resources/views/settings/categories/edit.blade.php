@extends('settings.categories.headings')

@section('content')
	<div class="container">
		<h2 class="header">Editar categoria : {{ $category->name }}</h2>
		<div class="section">
			{{--<p>Indique abaixo o nome que pretende atribuir à sua conta e o saldo respetivo na data escolhida.</p>--}}

			@include('partials.errors')

			{!! Form::model($category, ['method' => 'PATCH', 'url' => action('CategoryController@update', $category)]) !!}



			@include('settings.categories._form')

			<div class="row">
				<div class="col s12">
					{!! Form::submit('Editar', ['class' => 'btn waves-effect waves-light cyan btn-large']) !!}
					<button type="submit" form="delete-category-form" class="btn-floating btn-large waves-effect waves-circle waves-light red right"><i class="material-icons">delete</i></button>
				</div>
			</div>

			{!! Form::close() !!}

			{{-- Adds a button to delete the current section --}}
			{!! Form::open(['method' => 'DELETE', 'url' => action('CategoryController@destroy', $category), 'id' => 'delete-category-form']) !!}
			{!! Form::close() !!}


		</div>
	</div>
@endsection