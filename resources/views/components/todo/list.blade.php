@props(['todos', 'heading'])

<div class="col-xl-4 col-md-6 mb-4">
    <div class="card h-100">
        <div class="card-header">
            <div class="card-title mb-0 py-2">
                <h5 class="mb-0">{{$heading}}</h5>
            </div>
        </div>
        <div class="card-body">
            <ul {{$attributes(["class"=>"p-0 m-0 list-unstyled"])}}>
                @foreach($todos as $todo)
                    <x-todo.item :$todo />
                @endforeach
            </ul>
        </div>
    </div>
</div>
