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
                        {{--                        <span class="right">{{ format_balance($transaction_per_date->balance) }}</span>--}}
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

                {{--<tr class="card-panel grey lighten-1 z-depth-0 transaction-title">--}}
                {{--<td colspan="4" style="padding: 10px 15px;">--}}
                {{--<span>{{ $transaction_per_date->transaction_date->toFormattedDateString() }}</span>--}}
                {{--<span class="right">{{ format_balance($transaction_per_date->balance) }}</span>--}}
                {{--</td>--}}
                {{--</tr>--}}
                {{-- TODO agrupar por mes --}}
                {{--@foreach(\App\Transaction::where('transaction_date', $transaction_per_date->transaction_date->toDateString())->with('Account','Company','Category')->get() as $transaction)--}}
                {{--<tr data-action="{{ action('TransactionController@edit', $transaction) }}">--}}
                {{--<td>{{ $transaction->Category->prefix_name() }}{{ $transaction->Category->name }}</td>--}}
                {{--<td>{{ $transaction->Company->name }}</td>--}}
                {{--<td>{{ $transaction->Account->name }}</td>--}}
                {{--<td class="right-align {{ $transaction->ColorCode() }}"> {{ format_balance($transaction->FormattedAmount()) }}</td>--}}
                {{--</tr>--}}
                {{--@endforeach--}}
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


        $( document ).ready( function() {
            /*$('.update').click(function(e) {
                e.preventDefault();

                var url             = "http://clothing.app/updateProductOption";
                var $post             = {};
                $post.id            = $(this).attr('rel');
                $post.size            = $('#size_' + $post.id).val();
                $post.colour        = $('#colour_' + $post.id).val();
                $post.stock            = $('#stock_' + $post.id).val();

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $post,
                    cache: false,
                    success: function(data){
                        return data;
                    }
                });
                return false;
            });
*/
            $('#filter-data-form').on( 'submit', function() {

                //.....
                //show some spinner etc to indicate operation in progress
                //.....
                /*var url = $(this).prop('action');
                var $post   = {};
                $post.start = $('#start_date').val();
                $post.end   = $('#end_date').val();

                console.log($post);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $post,
                    cache: false,
                    success: function(data) {
                        console.log(data)
                    }
                });*/



                $.post(
                        $( this ).prop('action'),
                        {
                            "_token": $( this ).find( 'input[name=_token]' ).val(),
                            "start_date": $('#start_date').val(),
                            "end_date": $('#end_date').val()
                        },
                        function( data ) {
                            console.log(data)
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