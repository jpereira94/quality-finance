@extends('transactions.heading')

@section('content')
    <div class="container">
        <h2 class="header">Criar nova transação</h2>
        @include('partials.errors')
        {!! Form::open(['url' => action('TransactionController@store')]) !!}
        @include('transactions._form')
        {!! Form::submit('Criar', ['class' => 'btn waves-effect waves-light cyan']) !!}
        {!! Form::close() !!}
    </div>
@endsection