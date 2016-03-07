
<div class="row">
	<div class="input-field col s12">
		{!! Form::text('name', null) !!}
		{!! Form::label('name', 'Nome') !!}
	</div>

	<div class="col s12">
		<p>Se pretender inserir uma subcategoria, escolhe abaixo a categoria base. Caso contrário, deixe o campo abaixo em branco.</p>
	</div>

	<div class="input-field col s12">
		<select name="category_id" id="category_id">
			<option value="">Sem categoria base</option>

			@foreach($categories as $category_id => $category)
				<option value="{{ $category_id }}" @if(Form::getValueAttribute('category_id') == $category_id) selected="selected" @endif >{{ $category }}</option>
			@endforeach

		</select>
		{!! Form::label('category_id', 'Categoria base') !!}
	</div>
</div>


{{--<a class="waves-effect waves-light btn">Stuff</a>--}}
