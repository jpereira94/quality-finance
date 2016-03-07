
<div class="row">
	<div class="input-field col s12">
		{!! Form::text('name', null) !!}
		{!! Form::label('name', 'Nome') !!}
	</div>

	<div class="input-field col s6 end">
		{!! Form::text('color', null) !!}
		{!! Form::label('color', 'Cor') !!}
	</div>

	<div class="input-field col s12">
		{!! Form::textarea('notes', null, ['class' => 'materialize-textarea']) !!}
		{!! Form::label('notes', 'Notas') !!}
	</div>
</div>

{{--<a class="waves-effect waves-light btn">Stuff</a>--}}
