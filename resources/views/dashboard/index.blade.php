@section('metaTags')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@extends('layout')

@section('mainContent')
    <div class="row align-items-start mt-4">
        <h1 class="col">Todos</h1>
        <button type="button" class="btn btn-primary btn-md col col-auto me-2" data-bs-toggle="modal" data-bs-target="#addNewItemModal">
            Add
        </button>
    </div>

    <div class="row mt-5">
        <x-todo.list data-list="todo" heading="Todo" id="todo-list" :todos="$todoList"/>
        <x-todo.list data-list="in_progress" heading="In Progress" :todos="$inProgress"/>
        <x-todo.list data-list="done" heading="Done" :todos="$done"/>
    </div>

    <!-- Todo => Move to another file -->
    <div class="modal fade" id="addNewItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-3 p-md-5">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Add New Item</h3>
                    </div>

                    <x-form.form method="POST" noBorder="true" id="addNewItemForm">
                        <x-form.input-group
                            id="content"
                            icon="ti-pencil"
                            label="Content"
                            type="text"
                            required
                        />

                        <select class="status-select block mb-4" name="status">
                            <option value="todo">Todo</option>
                            <option value="in_progress">In Progress</option>
                            <option value="done">Done</option>
                        </select>
                    </x-form.form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/dashboard.js')
@endsection
