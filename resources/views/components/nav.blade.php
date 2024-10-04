<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column">
        @foreach ($items as $item)
        <li class="nav-item ">
            <a href="{{route($item['route'])}}" class="nav-link {{ $item['route'] == $active? 'active' : ''}} ">
                <i class="{{$item['icon']}}"></i>
                <p>
                    {{$item['title']}}
                </p>
            </a>
        </li>
        @endforeach
    </ul>
</nav>
<!-- /.sidebar-menu -->
