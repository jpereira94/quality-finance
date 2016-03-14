@extends('transactions.heading')

@section('content')
    <div class="container">

        <!-- Modal Structure -->
        <div id="filter-modal" class="modal modal-sm">
            {!! Form::open(['id' => 'filter-data-form', 'url' => action('TransactionController@filterData')]) !!}
            <div class="modal-content">
                <h4>Filtrar transações </h4>
                <p></p>
                    <div class="row">
                        <div class="input-field col s12">
                            {!! Form::text('start_date', $dates['first'], ['placeholder' => 'AAAA-MM-DD', 'id' => 'start_date']) !!}
                            {!! Form::label('start_date', 'Data início') !!}
                        </div>
                        <div class="input-field col s12">
                            {!! Form::text('end_date', $dates['last'], ['placeholder' => 'AAAA-MM-DD', 'id' => 'end_date']) !!}
                            {!! Form::label('end_date', 'Data fim') !!}


                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                {!! Form::submit('Filtrar', ['class' => 'modal-action modal-close waves-effect waves-green btn-flat']) !!}
                {{--<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>--}}
            </div>
            {!! Form::close() !!}
        </div>

        <table id="TransactionTable" class="highlight">
            <tr>
                <td>
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                </td>
            </tr>
            {{--@foreach($transactions as $date => $transaction_grouped)
                <tr class="card-panel transaction-title">
                    <td colspan="4" style="padding: 10px 15px;">
                        <span>{{ \Carbon\Carbon::createFromFormat('m-Y', $date)->formatLocalized('%B %Y') }}</span>
                        <span class="right">{{ format_balance($transaction_grouped->sum(function ($transaction){return $transaction['amount']*pow(-1,$transaction['is_expense']);})) }}</span>
                    </td>
                </tr>

                @foreach($transaction_grouped as $transaction)
                    <tr data-action="{{ action('TransactionController@edit', $transaction) }}">
                        <td>{{ $transaction->Category->compound_name }}</td>
                        <td>{{ $transaction->Company->name }}</td>
                        <td>{{ $transaction->Account->name }}</td>
                        <td class="right-align {{ $transaction->color_code }}"> {{ format_balance($transaction->FormattedAmount()) }}</td>
                    </tr>
                @endforeach
            @endforeach--}}
        </table>
    </div>
@endsection

@section('js')
    <script>
        $('#TransactionTable tbody tr:not(.transaction-title)').click(function() {
            //when user clicks on tr of the transaction table then redirect to the edit page
            window.location.href = $(this).attr('data-action')
        });

        //variable for debugging
//        var $dados;

        //sets the locale to print dates correctly formatted
        moment.locale('pt');


        function TransactionTableUpdated() {

            //holds the transaction table
            var table = $('#TransactionTable');
            //empty the table
            table.empty();
            table.append('<tr><td> <div class="progress"><div class="indeterminate"></div></div></td></tr>');


            //start the ajax request
            $.ajax({
                type: 'POST',
                url: '{{ action('TransactionController@filterData')  }}',
                data: {
                    //gets the necessary variables
//                    "_token": $('#filter-data-form').find( 'input[name=_token]' ).val(),
//                    'X-CSRF-TOKEN': $('[name="_token"]').val(),
                    "start_date": $('#start_date').val(),
                    "end_date": $('#end_date').val()
                },
                success: function( data ) {
                    //variable for debugging
                    //$dados = data;

                    // only execute this if the request was successful
                    if (data['status'] == 'success')
                    {
                        //holds the transactions for the filtering
                        var $transactions = data['transactions'];
                        //str that holds the new edit-action
                        var edit_action = '{{ action('TransactionController@edit', '000') }}';

                        //empty the table
                        table.empty();

                        //iterates through the transaction
                        //var key holds the date component of the transaction group
                        for (key in  $transactions)
                        {
                            //moment library similar to Carbon to format the date
                            var date = moment(key, "MM-YYYY").format('MMMM YYYY');

                            //append the 'header' per group
                            table.append(
                                    '<tr class="card-panel transaction-title">' +
                                    '<td colspan="4" style="padding: 10px 15px;">' +
                                    '<span>'+moment(key, "MM-YYYY").format('MMMM YYYY')+'' +
                                    '<span class="right">'+data['balances'][key]+'</span>' +
                                    '</td>' +
                                    '</tr>'
                            );

                            //iterate thorough each group of the transactions
                            for($transaction in $transactions[key])
                            {
                                table.append(
                                        '<tr onclick="window.location.href = \''+edit_action.replace('000',$transactions[key][$transaction]['id']) +'\'">' +
                                        '<td>'+$transactions[key][$transaction]['category']['compound_name']+'</td>' +
                                        '<td>'+$transactions[key][$transaction]['company']['name']+'</td>' +
                                        '<td>'+$transactions[key][$transaction]['account']['name']+'</td>' +
                                        '<td class="right-align '+$transactions[key][$transaction]['color_code']+'">'+$transactions[key][$transaction]['formatted_amount']+'</td>' +
                                        '</tr>'
                                );
                            }
                        }
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //holds the table name
                    var table = $('#TransactionTable');
                    //emptys the tables
                    table.empty();

                    table.append('<tr class="red white-text"><td  style="padding: 10px 15px; line-height: 30px"><i class="fa fa-exclamation-triangle right fa-2x"></i> An error occurred: <b>'+xhr.responseJSON.errors+'</b></td></tr>')
                },
                dataType: 'json'
            });

            return false;
        }

        $('#filter-data-form').on( 'submit', function() {
            TransactionTableUpdated();
            return false;
        } );


        $(document).ready( function() {
            //submit the form on first page load
            $('#filter-data-form').submit()
        });

    </script>
@endsection