@props(['exercise'])

<div class="exercise-item flex gap-3 mb-3 shadow rounded-md p-3 transition hover:bg-gray-100">
    <div>
        <img class="w-12 border rounded-full"
            src="{{ asset($exercise->muscle_group_icon) }}" alt="">
    </div>
    <div class="grow">
        <h4 class="font-bold text-black"> {{ $exercise->title }}</h4>
        <span>{{ $exercise->muscle_group }}
            @if ($exercise->user_id)
                <span
                    class="border border-indigo-700 text-indigo-700 rounded-md text-xs p-0.5">Your
                    exercise</span>
            @endif
        </span>
    </div>
    <button data-exercise="{{ $exercise->id }}">
        <div
            class="border rounded-full flex items-center justify-center p-1 border-gray-600 transition hover:bg-gray-100 ">
            <span class="icon-[tabler--plus]"></span>
        </div>
    </button>
</div>