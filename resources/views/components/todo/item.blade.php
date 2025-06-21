@props(['todo'])

<li {{$attributes([
    "class" => "mb-4 pb-1",
    "data-id"=> $todo->id
])}}
>
    <div class="row align-items-start">
        <div class="col">
            <h6 class="mb-0 text-wrap">{{$todo->content}}</h6>
        </div>

        <div class="col-auto ps-0">
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    <i class="ti ti-dots-vertical"></i>
                </button>

                <div class="dropdown-menu">
                    <a class="dropdown-item edit-item" data-id="{{$todo->id}}" href="javascript:void(0);">
                        <i class="ti ti-pencil me-1"></i> Edit
                    </a>
                    <a class="dropdown-item delete-item" data-id="{{$todo->id}}" href="javascript:void(0);">
                        <i class="ti ti-trash me-1"></i> Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
</li>
