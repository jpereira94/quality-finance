
<div class="row">
	<div class="input-field col s12">
		{!! Form::text('name', null) !!}
		{!! Form::label('name', 'Nome da conta') !!}
	</div>

	<div class="input-field col s6">
		{!! Form::text('working_capital', null) !!}
		{!! Form::label('working_capital', 'Saldo (€)') !!}
	</div>

	<div class="input-field col s6">
		{!! Form::input('date', 'balance_date', null, ['class' => 'datepicker', 'data-value' => date('Y-m-d')]) !!}
		{!! Form::label('balance_date', 'Na data de', ['class' => 'active']) !!}
	</div>

	<div class="input-field col s12">
		{!! Form::textarea('notes', null, ['class' => 'materialize-textarea']) !!}
		{!! Form::label('notes', 'Notas') !!}
	</div>
</div>

{{--<a class="waves-effect waves-light btn">Stuff</a>--}}
