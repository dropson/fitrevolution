<x-layout>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <a href="{{ URL::previous() }}" class="btn btn-warning">Back</a>
            <h3 class="font-bold text-black text-lg">Edit Your Workout</h3>
        </div>

        <div class="flex gap-5 mt-5">
            <div class="grow w-full">
                <div class="card min-h-screen">
                    <div class="card-body flex">

                        <form method="POST" action="{{ route('clients.workouts.update', $workout) }}">
                            @method('PATCH')
                            @csrf

                            <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
                                {{-- First Name --}}
                                @php
                                   $today = \Carbon\Carbon::today()->format('Y-m-d');
                                   $scheduledDate = $workout->schedule ? $workout->schedule->formatted_scheduled_date : null;
                                   $isPastDate = $scheduledDate && $scheduledDate < $today;
                                @endphp
                                <x-forms.input-group label="Training day" :disabled="$isPastDate" class="w-full" type="date" name="scheduled_date" id="scheduled_date"
                                value="{{ $workout->schedule->formatted_scheduled_date }}" :errors="$errors" minlength="5" />
                            </div>

                            <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
                                {{-- First Name --}}
                                <x-forms.input-group label="Title" class="w-full" name="title"
                                    value="{{ $workout->title }}" :errors="$errors" required minlength="5" />
                            </div>

                            <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
                                {{-- Instruction --}}
                                <div class="relative w-full">
                                    <textarea class="textarea textarea-filled peer bg-transparent" placeholder="" name="instruction" id="instruction">{{ $workout->instruction }}</textarea>
                                    <label class="textarea-filled-label" for="instruction">Write your
                                        instruction</label>
                                    <span class="textarea-filled-focused"></span>
                                    @error('instruction')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="exercise-list">
                                @error('exercises')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                                @forelse ($workout->templateWorkoutExercises as $exerciseIndex =>  $templateExercise)
                                    <div class="card mb-4">
                                        <div class="card-body p-3">
                                            <div class="flex gap-3">
                                                <span class="icon-[tabler--grid-dots] cursor-pointer p-2 mt-1.5"></span>
                                                <div class="flex flex-col flex-grow">
                                                    <div class="flex justify-between items-center mb-3">
                                                        <input type="hidden" name="exercises[{{ $exerciseIndex }}][id]"
                                                            value="{{ $templateExercise->exercise_id }}">
                                                        <input type="hidden"
                                                            name="exercises[{{ $exerciseIndex }}][template_workout_exercise_id]"
                                                            value="{{ $templateExercise->id }}">
                                                        <input type="hidden"
                                                            name="exercises[{{ $exerciseIndex }}][deleted]"
                                                            value="0" class="exercise-deleted">
                                                        <h5 class="card-title text-base flex items-center">
                                                            {{ $templateExercise->exercise->title }}
                                                            <span
                                                                class="badge badge-outline badge-info badge-sm ml-3 text-xs">{{ $templateExercise->exercise->muscle_group }}</span>
                                                        </h5>
                                                        <button type="button" class="remove-exercise">
                                                            <span class="icon-[tabler--trash] size-4"></span>
                                                        </button>
                                                    </div>
                                                    <div class="reps-list">
                                                        @forelse ($templateExercise->templateSets as $set)
                                                            <div class="flex gap-5 justify-end me-10">
                                                                <div class="flex items-center">
                                                                    <span class="font-bold text-sm mr-2">Sets</span>
                                                                    <input type="text"
                                                                        name="exercises[{{ $exerciseIndex }}][sets][0][sets_number]"
                                                                        value="{{ $set->sets_number }}"
                                                                        class="input input-sm w-14 text-center font-bold text-black">
                                                                </div>
                                                                <div class="flex items-center">
                                                                    <span class="font-bold text-sm mr-2">Reps</span>
                                                                    <input type="text"
                                                                        name="exercises[{{ $exerciseIndex }}][sets][0][repetitions]"
                                                                        value="{{ $set->repetitions }}"
                                                                        class="input input-sm w-14 text-center font-bold text-black">
                                                                </div>
                                                                <div class="flex items-center">
                                                                    <span class="font-bold text-sm mr-2">Weight
                                                                        (kg)
                                                                    </span>
                                                                    <input type="text"
                                                                        name="exercises[{{ $exerciseIndex }}][sets][0][weight]"
                                                                        value="{{ $set->weight }}"
                                                                        class="input input-sm w-20 text-center font-bold text-black">
                                                                </div>
                                                            </div>
                                                        @empty
                                                        @endforelse


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    empty
                                @endforelse
                            </div> --}}

                            <div
                                class="flex w-full items-center justify-center gap-3 mb-5 mt-10 flex-wrap sm:flex-nowrap">
                                <button type="submit" class="btn btn-primary btn-lg ">Update workout</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
            <div class="grow w-[500px]">
                <div class="card sticky top-20">
                    <div class="card-body">
                        <div class="mb-3">
                            <form action="">
                                <div class="flex gap-2 p-2">
                                    <div class="flex-1">
                                        <select name="muscle_group"
                                            data-select='{
                          "placeholder": "<span class=\"inline-flex items-center\"><span class=\"icon-[tabler--filter] flex-shrink-0 size-4 me-2\"></span> Muscle group</span>",
                          "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                          "toggleClasses": "advance-select-toggle",
                          "dropdownClasses": "advance-select-menu",
                          "optionClasses": "advance-select-option selected:active",
                          "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] flex-shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
                          "extraMarkup": "<span class=\"icon-[tabler--caret-up-down] flex-shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
                        }'
                                            class="hidden">
                                            <option value="">All</option>
                                            @foreach ($muscleGroups as $item)
                                                <option value="{{ $item->value }}"
                                                    {{ request('muscle_group') === $item->value ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <select name="equipment"
                                            data-select='{
                                  "placeholder": "<span class=\"inline-flex items-center\"><span class=\"icon-[tabler--filter] flex-shrink-0 size-4 me-2\"></span> Equipment </span>",
                                  "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                  "toggleClasses": "advance-select-toggle",
                                  "dropdownClasses": "advance-select-menu",
                                  "optionClasses": "advance-select-option selected:active",
                                  "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] flex-shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
                                  "extraMarkup": "<span class=\"icon-[tabler--caret-up-down] flex-shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
                                }'
                                            class="hidden">
                                            <option value="">Choose</option>
                                            @foreach ($equipments as $item)
                                                <option value="{{ $item->value }}"
                                                    {{ request('equipment') === $item->value ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="flex overflow-y-auto h-[590px] p-2">
                            <div>
                                @foreach ($exercises as $exercise)
                                    <x-exercise-list-item :$exercise />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
