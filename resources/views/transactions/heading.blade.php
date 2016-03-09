@extends('layouts.app')

@section('page-title', 'Transações')

@section('top-nav')
    <ul class="right">
        @if(Request::is('transaction'))
            <li>
                <a href="#filter-modal" class="modal-trigger">
                    <i class="fa fa-filter fa-2x"></i>
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

@if(Request::is('transaction'))
@section('footer')
    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">

                <a class="grey-text text-lighten-4 right" href="#!">
                    <i class="material-icons">save</i>
                </a>
            </div>
        </div>
    </footer>
@endsection
@endif