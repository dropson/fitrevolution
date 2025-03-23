@php

    $menuItems = [
        ['route' => 'clients.home', 'label' => 'Home'],
        ['route' => 'clients.workouts.index', 'label' => 'My workouts'],
        ['route' => '', 'label' => 'Calendar'],
        ['route' => '', 'label' => 'Progress'],
        ['route' => 'clients.exercises.index', 'label' => 'Exercies'],
    ];

@endphp

<ul class="menu menu-horizontal gap-2 p-0 text-base rtl:ml-20">
    @foreach ($menuItems as $item)
        @if (empty($item['route']))
            @continue
        @endif
        <li><a href="{{ route($item['route']) }}" @class(['active' => request()->routeIs($item['route'])])>
                {{ $item['label'] }}
            </a></li>
    @endforeach

</ul>
