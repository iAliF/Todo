@props(['href'])

<li class="nav-item">
    <a class="nav-link fw-medium {{request()->is($href) ? 'active' : ''}}" href="{{$href}}">{{$slot}}</a>
</li>
