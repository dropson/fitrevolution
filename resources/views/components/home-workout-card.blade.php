@props(['event'])
<div class="item border p-3 h-full relative rounded-md bg-indigo-600 text-white transition hover:bg-indigo-700">
    <div>
        <h3 class="font-black text-xl">{{ $event->workout->title }}</h3>
        <div class="text-xs">
            60 min · Abs, Arms, Chest
        </div>
        <div class="absolute left-3 bottom-1 font-semibold">

            <div class="tooltip mr-2">
                <button type="button" data-workout="{{ $event->workout->id }}"
                    class="tooltip-toggle flex  preview-workout" aria-label="Tooltip">
                    <span class="icon-[tabler--eye] size-7"></span>
                </button>
                <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                    <span class="tooltip-body">Preview</span>
                </span>
            </div>

            <div class="tooltip mr-2">
                <a href="{{ route('clients.workouts.edit', $event->workout) }}" class="tooltip-toggle flex"
                    aria-label="Tooltip">
                    <span class="icon-[tabler--pencil-minus] size-7"></span>
                </a>
                <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                    <span class="tooltip-body">Edit</span>
                </span>
            </div>
            @php
                $today = \Carbon\Carbon::today()->format('Y-m-d');
                $scheduledDate = $event->formatted_scheduled_date;
                $isNow = $scheduledDate === $today;
            @endphp
            @if ($isNow)
                @if ($event->status !== \App\Enums\WorkoutScheduleStatusEnum::Done)
                    <div class="tooltip mr-2">
                        <form method="POST" action="{{ route('clients.schedule.done', $event) }}">
                            @csrf
                            <input type="hidden" name="home_page" value="1">
                            <button class="tooltip-toggle flex" aria-label="Tooltip">

                                <span class="icon-[tabler--circle-check] size-7"></span>
                            </button>
                            <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible"
                                role="tooltip">
                                <span class="tooltip-body">Mark done</span>
                            </span>
                        </form>
                    </div>
                @endif
                @if ($event->status !== \App\Enums\WorkoutScheduleStatusEnum::Skipped)
                    <div class="tooltip mr-2">
                        <form method="POST" action="{{ route('clients.schedule.skipped', $event) }}">
                            @csrf
                            <input type="hidden" name="home_page" value="1">
                            <button class="tooltip-toggle flex" aria-label="Tooltip">

                                <span class="icon-[tabler--bolt-off] size-7"></span>
                            </button>
                            <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible"
                                role="tooltip">
                                <span class="tooltip-body">Mark skiped</span>
                            </span>
                        </form>
                    </div>
                @endif

            @endif

        </div>

        <div class="absolute right-3 bottom-1">
            <div class="tooltip mr-2">
                <form method="POST" action="{{ route('clients.schedule.destroy', $event) }}">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="home_page" value="1">
                    <button class="tooltip-toggle flex" aria-label="Tooltip">

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
