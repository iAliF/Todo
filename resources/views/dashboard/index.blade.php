@extends('layout')

@section('mainContent')
    <h1>Hello {{auth()->user()->name}}, Welcome.</h1>
@endsection
