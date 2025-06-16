<div class="card mb-4 mt-4">
    <div class="card-body">
        <form {{$attributes}}>
            {{ $slot }}

            @if(!isset($buttons))
                <button type="submit" class="mt-2 w-100 py-1 btn-lg btn btn-primary">Submit</button>
            @else
                {{$buttons}}
            @endif
        </form>
    </div>
</div>
