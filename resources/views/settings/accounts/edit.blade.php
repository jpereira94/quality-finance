@extends('settings.accounts.headings')

@section('content')
	<div class="container">
		<h2 class="header">Editar conta : {{ $account->name }}</h2>
		<div class="section">
			{{--<p>Indique abaixo o nome que pretende atribuir à sua conta e o saldo respetivo na data escolhida.</p>--}}

			@include('partials.errors')

			{!! Form::model($account, ['method' => 'PATCH', 'url' => action('AccountController@update', $account)]) !!}
			@include('settings.accounts._form')
			<div class="row">
				<div class="col s12">
					{!! Form::submit('Editar', ['class' => 'btn waves-effect waves-light cyan btn-large']) !!}
					<button type="submit" form="delete-account-form" class="btn-floating btn-large waves-effect waves-circle waves-light red right"><i class="material-icons">delete</i></button>
				</div>
			</div>

			{!! Form::close() !!}

			{{-- Adds a button to delete the current section --}}
			{!! Form::open(['method' => 'DELETE', 'url' => action('AccountController@destroy', $account), 'id' => 'delete-account-form']) !!}
			{!! Form::close() !!}


		</div>
	</div>
@endsection