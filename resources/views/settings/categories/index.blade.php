@extends('settings.categories.headings')

@section('content')
	<div class="container">

		<div class="collection with-header">
			{{--<a href="#!" class="collection-item"><h4>First Names</h4></a>--}}
			@forelse($categories as $category)
				<a href="{{ action('CategoryController@edit', $category) }}" class="collection-item">{{ $category->name }}</a>
				@foreach($category->Child()->get() as $category_child)
					<a href="{{ action('CategoryController@edit', $category_child) }}" class="collection-item"><i class="fa fa-level-up fa-rotate-90 fa-fw"></i> <span style="padding-left: 15px">{{ $category_child->name }}</span></a>
				@endforeach
			@empty
				<a href="{{ action('CategoryController@create') }}" class="collection-item">Não tem categorias criadas. Por favor crie uma categoria antes de continuar.</a>
			@endforelse
		</div>
	</div>
@endsection
