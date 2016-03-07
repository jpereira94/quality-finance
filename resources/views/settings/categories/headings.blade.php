@extends('layouts.app')

@section('page-title', 'Gerir categorias')
@section('page-title-link', action('CategoryController@index'))

@section('top-nav')
	<ul class="right">
		<li>
			<a href="{{ action('CategoryController@create') }}">
				<i class="material-icons">note_add</i>
			</a>
		</li>
	</ul>
@endsection
