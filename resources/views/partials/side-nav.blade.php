<header class="side-nav fixed">
	<ul id="nav-mobile" class="nav-menu">

		<li class="logo center-align white-text text-uppercase">
			<span style="color: rgba(255, 255, 255, 0.45); font-size: 1.8rem; line-height: 1.1;">Quality</span>
			<span style="display: block; font-size: 1.3rem">Contabilidade</span>
		</li>
		<li class="{{ set_active('/') }}">
			<a href="/">Visão Geral</a>
		</li>
		<li class="{{ set_active(action('TransactionController@index')) }}">
			<a href="{{ action('TransactionController@index') }}">Transações</a>
		</li>
		<li>
			<a href="#">Relatórios</a>
		</li>

		<li class="no-padding {{ set_active([action('AccountController@index'), action('CompanyController@index'), action('CategoryController@index')]) }}">
			<ul class="collapsible collapsible-accordion">
				<li>
					<a class="collapsible-header">Configurações <i class="fa fa-caret-down right" style="margin-right: 0"></i></a>
					<div class="collapsible-body">
						<ul>
							<li><a href="{{ action('AccountController@index') }}">Contas</a></li>
							<li><a href="{{ action('CompanyController@index') }}">Entidades</a></li>
							<li><a href="{{ action('CategoryController@index') }}">Categorias</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</li>

	</ul>

	<ul class="nav-account">
		<li class="bold">Contas</li>
		<li class="space"></li>

		@foreach($accounts as $account)
			<li><a href="{{ action('AccountController@edit', $account->id) }}">{{ $account->name }} <span class="right">{{ format_balance($account->balance) }}</span></a></li>
		@endforeach

		<li class="space"></li>
		<li class="total"><span class="text-uppercase grey-text" style="font-size: 0.75rem;">Património</span> <span class="right">{{ format_balance($totalBalance) }}</span> </li>
	</ul>
</header>