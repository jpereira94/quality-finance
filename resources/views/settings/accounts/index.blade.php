@extends('settings.accounts.headings')

@section('content')
	<div class="container">
		<table class="highlight" id="AccountTable">
			<thead>
			<tr>
				<th>Fundo de maneio</th>
				<th></th>
			</tr>
			</thead>

			<tbody>
			@forelse($accounts as $account)
				<tr data-action="{{ action('AccountController@edit', $account) }}">
					{{--<td><a href="{{ action('AccountController@edit', $account) }}"><i class="mdi-editor-mode-edit"></i> </a> </td>--}}
					<td>{{ $account->name }}</td>
					<td class="right-align">{{ format_balance($account->working_capital) }}</td>
				</tr>
			@empty
				<tr>
					<td colspan="2">
						Não existem contas criadas. Por favor crie uma conta antes de continuar.
					</td>
				</tr>
			@endforelse
			</tbody>
		</table>
	</div>
@endsection

@section('js')
	<script>
		$('#AccountTable tbody tr').click(function() {
			//when user clicks on tr of the account table then redirect to the edit page
			window.location.href = $(this).attr('data-action')
		})
	</script>
@endsection