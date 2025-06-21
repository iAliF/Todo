@props(['todos'])

<div class="col-xl-4 col-md-6 mb-4">
    <div class="card h-100">
        <div class="card-header">
            <div class="card-title mb-0">
                <h5 class="mb-0">Todo</h5>
            </div>
        </div>
        <div class="card-body">
            <ul class="p-0 m-0 list-unstyled">
                @foreach($todos as $todo)
                    <x-todo.item :$todo />
                @endforeach
            </ul>
        </div>
    </div>
</div>
