@extends('layouts.app')

@section('page-title', 'Visão Geral do Mês')

{{--@section('footer')
	<footer class="page-footer">
		<div class="footer-copyright">
			<div class="container">
				<a class="grey-text text-lighten-4 right" href="#!">
					<i class="material-icons">save</i>
				</a>
			</div>
		</div>
	</footer>
@endsection--}}


@section('content')

	<div class="container">
		<div class="row">
			<div class="col s6">
				<h3>Principais despesas</h3>
				<div id="expense-div" style="height: 600px; margin: -70px 0px -70px;"></div>
			</div>
			<div class="col s6">
				<h3>Principais receitas</h3>
				<div id="revenue-div" style="height: 600px; margin: -70px 0px -70px;"></div>
			</div>
		</div>
		<div class="row" style="display: flex">
			<div class="col s4" style="display: flex; flex-direction: column">
				<h3>Posição Financeira</h3>
				<h5>Receitas <span class="right tooltipped" data-position="right" data-delay="10" data-tooltip="No mês transato acumulou um total de receitas de {{ format_balance($previous_month_financial[0]) }}">{{ format_balance($current_month_financial[0]) }} <i class="{!! $arrow[0] !!}"></i></span></h5>
				<h5>Despesas <span class="right tooltipped" data-position="right" data-delay="10" data-tooltip="No mês transato acumulou um total de despesas de {{ format_balance($previous_month_financial[1]) }}">{{ format_balance($current_month_financial[1]) }} <i class="{!! $arrow[1] !!}"></i></span></h5>
				<p class="text-uppercase grey-text text-darken-3" style="margin-top: 0px; line-height: 37px">Saldo <span class="right" style="font-size: 1.64rem">{{ format_balance($current_month_financial[0]-$current_month_financial[1]) }} <i class="fa fa-caret-down fa-fw white-text">&nbsp;</i></span></p>
			</div>
			<div class="col s8" style="display: flex; flex-direction: column;">
				<div class="valign-wrapper" style="height: 100%; background-color: rgb(238, 238, 238); border: 2px dashed rgb(117, 117, 117);">
					<p class="flow-text valign center" style="width: 100%">Espaço para futura expansão. Sugestões são bem-vindas.</p>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<?= Lava::render('DonutChart', 'expense', 'expense-div') ?>
	<?= Lava::render('DonutChart', 'revenue', 'revenue-div') ?>
@endsection