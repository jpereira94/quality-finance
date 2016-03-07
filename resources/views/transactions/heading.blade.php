@extends('layouts.app')

@section('page-title', 'Transações')

@section('top-nav')
    <ul class="right">
        <li>
            <a href="{{ action('TransactionController@create') }}">
                <i class="material-icons">note_add</i>
            </a>
        </li>
    </ul>
@endsection