@section('metaTags')
    @csrf
@endsection

@extends('layout')

@section('mainContent')
    <div class="row mt-5">
        <x-todo.list :todos="$todoList"/>
        <x-todo.list :todos="$inProgress"/>
        <x-todo.list :todos="$done"/>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/dashboard.js')
@endsection
