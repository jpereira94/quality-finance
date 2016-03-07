@extends('settings.companies.headings')

@section('content')
	<div class="container">

		<div class="collection with-header">
			{{--<a href="#!" class="collection-item"><h4>First Names</h4></a>--}}
			@forelse($companies as $company)
				<a href="{{ action('CompanyController@edit', $company) }}" class="collection-item">{{ $company->name }}</a>
			@empty
				<a href="{{ action('CompanyController@create') }}" class="collection-item">Não tem entidades criadas. Por favor crie uma entidade antes de continuar.</a>
			@endforelse
		</div>
	</div>
@endsection
