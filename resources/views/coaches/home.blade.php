<x-layout>

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        {{-- Welcome --}}
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-black text-lg">Clients</h3>
            <a href="{{ route('coaches.clients.create') }}" class="btn btn-success">Create Client</a>
        </div>

        {{-- Clients --}}

        <div class="w-full">
            <table class="table">
                <thead>
                    <tr class="border-none">
                        <th class="text-center font-bold text-xs">Name</th>
                        <th class="text-center font-bold text-xs">Workouts <br> done</th>
                        <th class="text-center font-bold text-xs">Workouts <br> scheduled</th>
                        <th class="text-center font-bold text-xs">Today</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($coach->clientsAsCoach as $client)
                        <tr
                            class="row-hover border-gray-100 border-2 bg-white transition-all scale-100 hover:scale-[1.02]">
                            <td class="p-4">
                                <div class="flex gap-3">
                                    <div class="avatar placeholder">
                                        <div
                                            class="@if ($client->gender->value === App\Enums\UserGenderEnum::Male->value) bg-accent/70
                                        @else
                                            bg-error/70 @endif 
                                            text-secondary-content w-15 rounded-3xl">
                                            <span class="text-2xl uppercase"><span
                                                    class="font-bold">{{ Str::substr($client->first_name, 0, 1) }}</span>
                                                {{ Str::substr($client->last_name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ $client->first_name }}
                                            {{ Str::substr($client->last_name, 0, 1) }}</div>
                                        <div class="text-sm">
                                            @if ($client->clientProfile->invitation_token)
                                                <button class=" font-semibold h text-blue-700 over:underline preview-invite-client"
                                                    data-client-id="{{ $client->id }}"
                                                    data-invite="{{ $client->clientProfile->generateInvitationLink() }}"
                                                    data-name="{{ $client->first_name }}">Invite clinet</button>
                                            @else
                                                Online 2 days ago
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            {{-- Workouts done --}}
                            <td class="p-4 text-center">
                                <span
                                    class="badge @if (false) badge-success @else badge-warning @endif p-3 rounded-2xl py-4 font-bold">
                                    3 / 7
                                </span>
                            </td>
                            {{-- Workouts scheduled --}}
                            <td class="p-4 text-center">
                                <span
                                    class="badge @if (true) badge-success @else badge-error @endif p-3 rounded-2xl py-4 font-bold">
                                    3
                                </span>
                            </td>
                            {{-- Workout Name --}}
                            <td class="p-4 text-center">
                                @if (true)
                                    <a href=""
                                        class=" font-bold text-accent/80 transition-all hover:text-accent">Workout
                                        Name</a>
                                @else
                                    Rest day
                                @endif
                            </td>
                            {{-- Actions --}}
                            <td class="p-4 text-end">
                                <div class="tooltip mr-2">
                                    <a href="" class="tooltip-toggle flex " aria-label="Tooltip">
                                        <span class="icon-[tabler--square-rounded-plus-2] size-5"></span>
                                    </a>
                                    <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible"
                                        role="tooltip">
                                        <span class="tooltip-body">Assign workout</span>
                                    </span>
                                </div>

                                <div class="dropdown relative inline-flex [--placement:bottom-start] sm:[--placement:right-start]">
                                    <button id="dropdown-menu-icon" type="button"
                                        class="btn btn-circle btn-text btn-sm" aria-haspopup="menu"
                                        aria-expanded="false" aria-label="Dropdown">
                                        <span class="icon-[tabler--dots-vertical] size-5 "></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-40 text-sm"
                                        role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu-icon">
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
                                                <button type="submit" class="dropdown-item"
                                                    onclick="return confirm('Are you sure?')" href="">Delete
                                                    client</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layout>
