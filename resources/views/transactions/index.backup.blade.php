@extends('transactions.heading')

@section('content')
    <div class="container">

        <table style="margin-top: 7px" id="TransactionTable" class="highlight">

            @foreach($transactions as $transaction_per_date)
                <tr class="card-panel grey lighten-1 z-depth-0 transaction-title">
                    <td colspan="4" style="padding: 10px 15px;">
                        <span>{{ $transaction_per_date->transaction_date->toFormattedDateString() }}</span>
                        <span class="right">{{ format_balance($transaction_per_date->balance) }}</span>
                    </td>
                </tr>
                {{-- TODO agrupar por mes --}}
                @foreach(\App\Transaction::where('transaction_date', $transaction_per_date->transaction_date->toDateString())->with('Account','Company','Category')->get() as $transaction)
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
        })
    </script>
@endsection