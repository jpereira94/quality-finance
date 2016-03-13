@extends('transactions.heading')

@section('content')
    <div class="container">
        <h2 class="header">Editar transação</h2>
        @include('partials.errors')
        {!! Form::model($transaction, ['method' => 'PATCH', 'url' => action('TransactionController@update', $transaction)]) !!}
        @include('transactions._form')

        <div class="row">
            <div class="col s12">
                {!! Form::submit('Editar', ['class' => 'light-blue accent-4 btn-large']) !!}
                <button type="submit" form="delete-transaction-form" class="btn-floating btn-large waves-effect waves-circle waves-light red right"><i class="material-icons">delete</i></button>
            </div>
        </div>
        {!! Form::close() !!}

        {{-- Adds a button to delete the current section --}}
        {!! Form::open(['method' => 'DELETE', 'url' => action('TransactionController@destroy', $transaction), 'id' => 'delete-transaction-form']) !!}
        {!! Form::close() !!}
    </div>
@endsection