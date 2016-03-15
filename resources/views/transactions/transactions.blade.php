@extends('layouts.pdf')

@section('content')
    <div class="container">
        <h3 class="text-uppercase center-align">Transações realizadas</h3>
        <p class="flow-text">Período: {{ \App\Transaction::orderBy('transaction_date')->select('transaction_date')->get()->first()->transaction_date->toDateString() }} a {{ \App\Transaction::orderBy('transaction_date')->select('transaction_date')->get()->last()->transaction_date->toDateString() }}</p>
{{-->>> App\Transaction::latest('transaction_date')->first()->transaction_date--}}
           <table class="bordered pdf">
                <tr>
                    <th class="center-align">Data</th>
                    <th class="center-align">Conta</th>
                    <th class="center-align">Entidade</th>
                    <th class="center-align">Categoria</th>
                    <th class="center-align">Valor</th>
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

        </table>

    </div>
@endsection