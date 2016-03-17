@extends('layouts.app')

@section('page-title', 'Relatório')

@section('top-nav')
    <ul class="right">
        <li>
            <a href="{{ action('ReportsController@rawRequest') }}">
                <i class="fa fa-terminal fa-2x"></i>
            </a>
        </li>
    </ul>
@endsection

