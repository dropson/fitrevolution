@props(['exercise'])

<div class="flex-1 card border-primary text-primary border bg-transparent shadow-none s">
    <div class="card-body p-3">

        <div class="flex w-full items-center justify-between mb-3">

            <img src="{{ asset($exercise->muscle_group_icon) }}" class="w-12" alt="muscle icon">
            @if ($exercise->user_id)
                <div class="flex">
                    <div class="dropdown relative inline-flex rtl:[--placement:bottom-end]">
                        <button id="dropdown-menu-icon" type="button"
                            class="dropdown-toggle btn btn-square btn-primary w-7 min-h-5 h-7" aria-haspopup="menu"
                            aria-expanded="false" aria-label="Dropdown">
                            <span class="icon-[tabler--dots-vertical] size-4 "></span>
                        </button>
                        <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-40 text-sm" role="menu"
                            aria-orientation="vertical" aria-labelledby="dropdown-menu-icon">
                            <li><a class="dropdown-item" href="{{ route('clients.exercises.edit', $exercise) }}">Edit exercies</a></li>
                            <li>
                                <form method="POST" action="{{ route('clients.exercises.destroy', $exercise) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')"
                                        href="{{ route('clients.exercises.destroy', $exercise) }}">Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        <h4 class="mb-2 text-base font-bold min-h-11">{{ $exercise->title }}
        </h4>
        <p class="text-black mb-3">
            {{ $exercise->short_instruction }}
        </p>
        <p class="text-sm text-black font-semibold">{{ $exercise->muscle_group }} / {{ $exercise->equipment }}</p>
    </div>
</div>
