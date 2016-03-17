@extends('layouts.app')

@section('page-title', 'Transações')

@section('top-nav')
    <ul class="right">
        @if(Request::is('transaction'))
            <li>
                <a class="modal-trigger" href="#filter-modal">
                    <i class="fa fa-filter fa-2x"></i>
                </a>
            </li>
            <li>
                <a class="modal-trigger"  href="#generate-pdf">
                    <i class="material-icons">save</i>
                </a>
            </li>
        @endif

        <li>
            <a href="{{ action('TransactionController@create') }}">
                <i class="material-icons">note_add</i>
            </a>
        </li>

    </ul>
@endsection

