@extends('layouts.pdf')

@section('content')
    <div class="container">
        <h3 class="text-uppercase center-align">Transações realizadas</h3>

        <p style="margin: 0">Período: <b>{{$filtering['start_date']}} a {{ $filtering['end_date'] }}</b> <span class="right">{{ \Carbon\Carbon::now()->toDateTimeString() }}</span></p>
        <p style="margin: 0">Tipo de transações:&nbsp;<b>{{ $filtering['show'] }}</b></p>
        <p style="margin: 0; padding-bottom: 10px">Conta: <b>{{ $filtering['account'] }}</b></p>
{{-->>> App\Transaction::latest('transaction_date')->first()->transaction_date--}}
           <table class="bordered pdf">
                <tr>
                    <th class="center-align" width="12%">Data</th>
                    <th class="center-align" width="15%">Conta</th>
                    <th class="center-align">Entidade</th>
                    <th class="center-align">Categoria</th>
                    <th class="center-align" width="12%">Valor</th>
                </tr>

            @foreach($transactions as $transaction)
                <tr>
                    <td class="center-align">{{ $transaction->transaction_date->toDateString() }}</td>
                    <td>{{ $transaction->Account->name }}</td>
                    <td>{{ $transaction->Company->name }}</td>
                    <td>{{ $transaction->Category->compound_name }}</td>
                    <td class="right-align">{{ $transaction->FormattedAmount(true) }}</td>
                </tr>
            @endforeach
               <tr>
                   <td colspan="4">Total</td>
                   <td class="right-align">{{ format_balance($transactions->sum('formatted_amount')) }}</td>
               </tr>
        </table>
    </div>
@endsection