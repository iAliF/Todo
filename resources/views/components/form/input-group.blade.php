@props(['id', 'label', 'icon', 'name'])

<div class="mb-3">
    <label class="form-label" for="{{$id}}">{{$label}}</label>

    <div class="input-group input-group-merge">
        <span id="{{$id}}-span" class="input-group-text">
            <i class="ti {{$icon}}"></i>
        </span>

        <input
            {{$attributes([
                "type" => "text",
                "id" => $id,
                "name" => $name ?? $id,
                "class"=> "form-control",
                "aria-describedby"=> "{$id}-span"
])}}
        />
    </div>
</div>
