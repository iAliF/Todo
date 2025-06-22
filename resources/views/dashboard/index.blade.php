@section('metaTags')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@extends('layout')

@section('mainContent')
    <div class="row align-items-start mt-4">
        <h1 class="col">Todos</h1>
        <button type="button" class="btn btn-primary btn-md col col-auto me-2" data-bs-toggle="modal"
                data-bs-target="#addNewItemModal">
            Add
        </button>
    </div>

    <div class="row mt-5">
        <x-todo.list data-list="todo" heading="Todo" id="todo-list" :todos="$todoList"/>
        <x-todo.list data-list="in_progress" heading="In Progress" :todos="$inProgress"/>
        <x-todo.list data-list="done" heading="Done" :todos="$done"/>
    </div>

    <x-modal.form method="POST" title="Add New Item" modal-id="addNewItemModal" form-id="addNewItemForm" />
    <x-modal.form method="PATCH" title="Edit Item" modal-id="editItemModal" form-id="editItemForm" />
@endsection

@section('scripts')
    @vite('resources/js/dashboard.js')
@endsection
