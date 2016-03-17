@extends('reports.headings')

@section('content')
    <div class="container">
        <h2 class="header">Executar SQL</h2>

        {!! Form::open(['method' => 'post', 'url' => action('ReportsController@rawGet')]) !!}

        <div class="input-field">
            {!! Form::textarea('sql_request', null, ['class' => 'materialize-textarea']) !!}
            {!! Form::label('sql_request', 'Script', ['style' => 'left:0']) !!}
        </div>

        {!! Form::submit('Enviar') !!}

        {!! Form::close() !!}

        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda aut commodi dolor ea, eligendi enim, eum exercitationem magnam molestias necessitatibus nesciunt quibusdam reiciendis repellendus reprehenderit sit totam unde ut vero!
    </div>
@endsection