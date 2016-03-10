@extends('layouts.pdf')

@section('content')
    <div class="container">
        <h3 class="text-uppercase center-align">Transações realizadas</h3>
        <p>{{ \App\Transaction::latest('transaction_date')->first()->transaction_date->toDateString() }} a {{ \App\Transaction::latest('transaction_date')->first()->transaction_date->toDateString() }}</p>
{{-->>> App\Transaction::latest('transaction_date')->first()->transaction_date--}}
           <table class="bordered pdf">
            <thead>
                <tr>
                    <th class="center-align">Data</th>
                    <th class="center-align">Conta</th>
                    <th class="center-align">Entidade</th>
                    <th class="center-align">Categoria</th>
                    <th class="center-align">Valor</th>
                </tr>
            </thead>
            <tbody>

            @foreach($transactions as $transaction)
                <tr>
                    <td class="center-align">{{ $transaction->transaction_date->toDateString() }}</td>
                    <td>{{ $transaction->Account->name }}</td>
                    <td>{{ $transaction->Company->name }}</td>
                    <td>{{ $transaction->Category->compound_name }}</td>
                    <td class="right-align">{{ $transaction->FormattedAmount(true) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection