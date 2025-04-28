@php

    $menuItems = [
        ['route' => 'coaches.clients.show','label' => 'Home'],
        ['route' => 'coaches.clients.workout_templates.index', 'label' => 'My workouts'],
    ];
@endphp

<nav class="navbar rounded-box shadow-base-300/20 shadow-sm">
    <div class="w-full">
        <div class="flex items-center justify-between  gap-15">
            {{-- Client name and back button --}}
            <div class="flex items-center justify-between">
                <a class="link text-base-content link-neutral text-xl font-bold no-underline mr-4"
                    href="{{ route('coaches.home') }}"><span class="icon-[tabler--backspace-filled] size-9"></span></a>
                <div class="avatar placeholder mr-4">
                    <div
                        class="@if ($client->gender->value === App\Enums\UserGenderEnum::Male->value) bg-accent/70
            @else
                bg-error/70 @endif 
                text-secondary-content w-12 rounded-2xl">
                        <span class="text-1xl uppercase"><span
                                class="font-bold">{{ Str::substr($client->first_name, 0, 1) }}</span>
                            {{ Str::substr($client->last_name, 0, 1) }}</span>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="font-bold text-xl hover:text-primary transition-all">{{ $client->first_name }}
                        {{ Str::substr($client->last_name, 0, 1) }}</div>
                    <div class="text-xs">
                        @if ($client->clientProfile->invitation_token)
                            <button
                                class=" font-semibold h text-blue-700 over:underline preview-invite-client hover:underline"
                                data-client-id="{{ $client->id }}"
                                data-invite="{{ $client->clientProfile->generateInvitationLink() }}"
                                data-name="{{ $client->first_name }}">Invite clinet</button>
                        @else
                            Online 2 days ago
                        @endif
                    </div>
                </div>
            </div>
            {{-- Workouts info --}}
            <div class="flex gap-10">
                <div class="flex justify-center items-center gap-3">
                    <span
                        class="badge @if (false) badge-success @else badge-warning @endif p-3 rounded-2xl py-4 font-bold">
                        3 / 7
                    </span>
                    <div class="text-sm/4 text-gray-500">
                        Workouts <br> completed
                    </div>
                </div>
                <div class="flex justify-center items-center gap-3">
                    <span
                        class="badge @if (true) badge-success @else badge-error @endif p-3 rounded-2xl py-4 font-bold">
                        3
                    </span>
                    <div class="text-sm/4 text-gray-500">
                        Workouts <br> scheduled
                    </div>
                </div>
            </div>
            <div class="grow flex justify-end items-center">
                <ul class="menu menu-horizontal gap-2 p-0 text-base max-md:mt-2 justify-end mr-4">
                    @foreach ($menuItems as $item)
                        @if (empty($item['route']))
                            @continue
                        @endif
                        <li><a href="{{ route($item['route'], $client) }}" @class(['active' => request()->routeIs($item['route'])])>
                                {{ $item['label'] }}
                            </a></li>
                    @endforeach
                </ul>

                <div class="dropdown relative inline-flex">
                    <button id="dropdown-menu-user" type="button"
                        class="dropdown-toggle btn hover:bg-primary transition-all pl-2 pr-2" aria-haspopup="menu"
                        aria-expanded="false" aria-label="Dropdown">
                        <span class="icon-[tabler--user-heart] size-7"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60" role="menu"
                        aria-orientation="vertical" aria-labelledby="dropdown-menu-user">
                        <li><a class="dropdown-item" href="">Profile and settings</a>
                        </li>
                        <li><a class="dropdown-item" href="">Jump to workouts</a>
                        </li>
                        <li><a class="dropdown-item" href="">Pause client</a>
                        </li>
                        <li>
                            <form method="POST" action="">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')"
                                    href="">Delete
                                    client</button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
</nav>
