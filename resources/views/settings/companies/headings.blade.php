@extends('layouts.app')

@section('page-title', 'Gerir entidades')
@section('page-title-link', action('CompanyController@index'))

@section('top-nav')
	<ul class="right">
		<li>
			<a href="{{ action('CompanyController@create') }}">
				<i class="material-icons">note_add</i>
			</a>
		</li>
	</ul>
@endsection
