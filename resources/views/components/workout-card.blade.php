@props(['workout', 'routePrefix', 'client' => null])

<div class="card w-full h-48">
    <div class="card-body flex p-0">
        <div class="p-3 h-full relative rounded-md bg-indigo-600 text-white transition hover:bg-indigo-700">
            <div>
                <h3 class="font-black text-xl">{{ $workout->title }}</h3>
                <div class="text-xs">
                    60 min ·
                    {{-- TODO --}}
                    @foreach ($workout->muscle_groups as $group)
                        {{ $group }}
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>
                <div class="absolute left-3 bottom-1 font-semibold">

                    <div class="tooltip mr-2">
                        <button type="button" data-workout="{{ $workout->id }}" class="tooltip-toggle flex preview-template" aria-label="Tooltip">
                            <span class="icon-[tabler--eye] size-7"></span>
                        </и>
                        <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                            <span class="tooltip-body">Preview</span>
                        </span>
                    </div>

                    <div class="tooltip mr-2">
                        <a href="{{ route($routePrefix.'.workout_templates.edit', $client ? [$client, $workout] : $workout) }}" class="tooltip-toggle flex" aria-label="Tooltip">
                            <span class="icon-[tabler--pencil-minus] size-7"></span>
                        </a>
                        <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                            <span class="tooltip-body">Edit</span>
                        </span>
                    </div>

                    <div class="tooltip mr-2">
                        <button type="button"  data-id="{{ $workout->id }}" data-title="{{ $workout->title }}" class="tooltip-toggle flex preview-assign-date" aria-label="Tooltip">

                            <span class="icon-[tabler--square-rounded-plus-2] size-7"></span>
                        </button>
                        <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                            <span class="tooltip-body">Assign date</span>
                        </span>
                    </div>
                </div>

                <div class="absolute right-3 bottom-1">
                    <div class="tooltip mr-2">
                        <form method="POST" action="{{ route($routePrefix.'.workout_templates.destroy', $client ? [$client, $workout] : $workout) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="tooltip-toggle flex" aria-label="Tooltip" onclick="return confirm('Are you sure?')">
                                <span class="icon-[tabler--trash] size-7"></span>
                            </button>
                            <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible"
                                role="tooltip">
                                <span class="tooltip-body">Delete</span>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
