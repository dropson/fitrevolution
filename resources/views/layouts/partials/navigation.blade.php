@role(App\Enums\UserRoleEnum::Coach->value)
    @php
        $menuItems = [
            ['route' => 'coaches.home', 'label' => 'Home'],
            ['route' => '', 'label' => 'Workouts'],
            ['route' => '', 'label' => 'Calendar'],
        ];
    @endphp
@else
    @php
        $menuItems = [
            ['route' => 'clients.home', 'label' => 'Home'],
            ['route' => 'clients.workout_templates.index', 'label' => 'My workouts'],
            ['route' => 'clients.calendar.index', 'label' => 'Calendar'],
            ['route' => '', 'label' => 'Progress'],
            ['route' => 'clients.exercises.index', 'label' => 'Exercies'],
        ];
    @endphp
@endrole


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
