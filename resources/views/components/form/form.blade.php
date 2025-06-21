@props([
    'noBorder' => 'false'
])

<div class="card mb-4 mt-4 {{strtolower($noBorder) === "true" ? 'border-0' : ''}}">
    <div class="card-body">
        <form {{$attributes}} >
            @if(strtolower($attributes["method"]) !== "GET")
                @csrf
                @method($attributes["method"])
            @endif

            {{ $slot }}

            @if(!isset($buttons))
                <button type="submit" class="mt-2 w-100 py-1 btn-lg btn btn-primary">Submit</button>
            @else
                {{$buttons}}
            @endif
        </form>
    </div>
</div>
