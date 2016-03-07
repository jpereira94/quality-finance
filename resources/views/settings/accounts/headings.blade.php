@extends('layouts.app')

@section('page-title', 'Gerir contas')
@section('page-title-link', action('AccountController@index'))

@section('top-nav')
	<ul class="right">
		<li>
			<a href="{{ action('AccountController@create') }}">
				<i class="material-icons">note_add</i>
			</a>
		</li>
	</ul>
@endsection
