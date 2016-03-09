@extends('transactions.heading')

@section('content')
    <div class="container">

        <!-- Modal Trigger -->
        <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>

        <!-- Modal Structure -->
        <div id="filter-modal" class="modal modal-sm">
            <div class="modal-content">
                <h4>Filtrar</h4>
                {!! Form::open(['id' => 'filter-data-form', 'url' => action('TransactionController@filterData')]) !!}
                {{--<form id="filter-data-form" action="{{ action('TransactionController@filterData') }}">--}}
                    <div class="row">
                        <div class="input-field col s12">
                            {!! Form::text('start_date', null, ['placeholder' => 'AAAA-MM-DD', 'id' => 'start_date']) !!}
                            {!! Form::label('start_date', 'Data início') !!}
                        </div>
                        <div class="input-field col s12">
                            {!! Form::text('end_date', null, ['placeholder' => 'AAAA-MM-DD', 'id' => 'end_date']) !!}
                            {!! Form::label('end_date', 'Data fim') !!}
                        </div>
                    </div>

                {!! Form::submit() !!}
                {{--</form>--}}
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
            </div>
        </div>

        <table style="margin-top: 7px" id="TransactionTable" class="highlight">

            @foreach($transactions as $date => $transaction_grouped)
                <tr class="card-panel grey lighten-1 z-depth-0 transaction-title">
                    <td colspan="4" style="padding: 10px 15px;">
                        <span>{{ \Carbon\Carbon::createFromFormat('m-Y', $date)->formatLocalized('%B %Y') }}</span>
                        <span class="right">{{ format_balance($transaction_grouped->sum(function ($transaction){return $transaction['amount']*pow(-1,$transaction['is_expense']);})) }}</span>
                    </td>
                </tr>

                @foreach($transaction_grouped as $transaction)
                    <tr data-action="{{ action('TransactionController@edit', $transaction) }}">
                        <td>{{ $transaction->Category->prefix_name() }}{{ $transaction->Category->name }}</td>
                        <td>{{ $transaction->Company->name }}</td>
                        <td>{{ $transaction->Account->name }}</td>
                        <td class="right-align {{ $transaction->ColorCode() }}"> {{ format_balance($transaction->FormattedAmount()) }}</td>
                    </tr>
                @endforeach

            @endforeach

        </table>

    </div>
@endsection

@section('js')
    <script>
        $('#TransactionTable tbody tr:not(.transaction-title)').click(function() {
            //when user clicks on tr of the transaction table then redirect to the edit page
            window.location.href = $(this).attr('data-action')
        });

        var $dados;

        moment.locale('pt')

        $( document ).ready( function() {

            $('#filter-data-form').on( 'submit', function() {

                $.post(
                        $( this ).prop('action'),
                        {
                            "_token": $( this ).find( 'input[name=_token]' ).val(),
                            "start_date": $('#start_date').val(),
                            "end_date": $('#end_date').val()
                        },
                        function( data ) {
                            console.log(data)
                            $dados = data;
                            if (data['status'] == 'success')
                            {
                                var table = $('#TransactionTable');
                                table.empty();
                                var $transactions = data['transactions'];

                                for (key in  $transactions)
                                {
	                                var date = moment(key, "MM-YYYY").format('MMMM YYYY');

                                    table.append(
                                            '<tr class="card-panel grey lighten-1 z-depth-0 transaction-title">' +
                                                '<td colspan="4" style="padding: 10px 15px;">' +
                                                    '<span>'+moment(key, "MM-YYYY").format('MMMM YYYY')+'' +
                                                    '<span class="right">'+data['balances'][key]+'</span>' +
                                                '</td>' +
                                            '</tr>'
                                    );

	                                for($transaction in $transactions[key])
	                                {
		                                table.append(
				                                '<tr data-action="{{ action('TransactionController@edit', $transaction) }}">'+
						                                /* TODO ver se meter o getNameAttribute devolve logo o nome certo */
				                                '<td>{{ $transaction->Category->prefix_name() }}{{ $transaction->Category->name }}</td>' +
				                                '' +
				                                ''
		                                );
		                                {{--<tr data-action="{{ action('TransactionController@edit', $transaction) }}">--}}
			                                {{--<td>{{ $transaction->Category->prefix_name() }}{{ $transaction->Category->name }}</td>--}}
			                                {{--<td>{{ $transaction->Company->name }}</td>--}}
			                                {{--<td>{{ $transaction->Account->name }}</td>--}}
			                                {{--<td class="right-align {{ $transaction->ColorCode() }}"> {{ format_balance($transaction->FormattedAmount()) }}</td>--}}
		                                {{--</tr>--}}

	                                }
                                }

//                                for(key in transactions['01-2016']) console.log(key)
//                                Object.keys(transactions).length
//                                for each (var $transaction in $transactions)
//                                {
//                                    console.log($transaction)
//                                }

                            }
                            console.log(data['transactions'])
                            //do something with data/response returned by server
                        },
                        'json'
                );

                //.....
                //do anything else you might want to do
                //.....

                //prevent the form from actually submitting in browser
                return false;
            } );

        } );

    </script>
@endsection