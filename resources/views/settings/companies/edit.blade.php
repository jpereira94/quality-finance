@extends('settings.companies.headings')

@section('content')
	<div class="container">
		<h2 class="header">Editar entidade : {{ $company->name }}</h2>
		<div class="section">
			{{--<p>Indique abaixo o nome que pretende atribuir à sua conta e o saldo respetivo na data escolhida.</p>--}}

			@include('partials.errors')

			{!! Form::model($company, ['method' => 'PATCH', 'url' => action('CompanyController@update', $company)]) !!}
			@include('settings.companies._form')
			<div class="row">
				<div class="col s12">
					{!! Form::submit('Editar', ['class' => 'btn waves-effect waves-light cyan btn-large']) !!}
					<button type="submit" form="delete-company-form" class="btn-floating btn-large waves-effect waves-circle waves-light red right"><i class="material-icons">delete</i></button>
				</div>
			</div>

			{!! Form::close() !!}

			{{-- Adds a button to delete the current section --}}
			{!! Form::open(['method' => 'DELETE', 'url' => action('CompanyController@destroy', $company), 'id' => 'delete-company-form']) !!}
			{!! Form::close() !!}


		</div>
	</div>
@endsection