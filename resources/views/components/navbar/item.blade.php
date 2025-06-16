@props(['to'])

<li class="nav-item">
    <a class="nav-link fw-medium {{request()->routeIs($to) ? 'active' : ''}}" href="{{route($to)}}">{{$slot}}</a>
</li>
