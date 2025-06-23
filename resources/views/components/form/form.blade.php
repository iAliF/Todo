@props([
    'noBorder' => 'false',
    'header' => null
])


<div class="row justify-content-center px-4">
    <div class="card my-4 {{strtolower($noBorder) === "true" ? 'border-0 col-12' : 'col-sm-12 col-md-10 col-lg-6'}}">

        <div class="card-body">
            @if(isset($header))
                <h1 class="card-title text-center mb-2">{{$header}}</h1>
                <hr class="mb-4"/>
            @endif

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
</div>
