@props([
    'routePrefix' => '',
    'routeParams' => [],
    'exercises',
    'isEditableByClient' => true,
    'isVisibleToClient' => true,
])
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="flex items-center justify-between">
        <a href="{{ route($routePrefix . '.workout_templates.index', $routeParams) }}" class="btn btn-warning">Back</a>
        <h3 class="font-bold text-black text-lg">Create Workout</h3>
    </div>
    <div class="flex gap-5 mt-5">
        <div class="grow w-full">
            <div class="card min-h-screen">
                <div class="card-body flex">

                    <form method="POST" action="{{ route($routePrefix . '.workout_templates.store', $routeParams) }}">
                        @csrf
                        {{-- Checkbox if user can edit workout template  --}}
                        @if (auth()->user()->hasRole(\App\Enums\UserRoleEnum::Coach->value) && Route::currentRouteName() === 'coaches.clients.workout_templates.create')
                            <ul
                                class="border-base-content/25 divide-base-content/25 rounded-box flex w-full flex-col border *:w-full *:cursor-pointer max-sm:divide-y sm:flex-row sm:divide-x mb-4">
                                <li class="w-full">
                                    <label class="flex items-center gap-3 p-3">
                                        <input type="hidden" name="is_editable_by_client" value="0">
                                        <input type="checkbox" class="checkbox checkbox-primary"
                                            name="is_editable_by_client" id="is_editable_by_client" value="1"
                                            {{ old('is_editable_by_client', $isEditableByClient) ? 'checked' : '' }}
                                            class="checkbox" />
                                        <span class="label-text text-base"> Allow client to edit tempate </span>
                                    </label>
                                </li>
                                <li class="w-full">
                                    <label class="flex items-center gap-3 p-3">
                                        <input type="hidden" name="is_visible_to_client" value="0">
                                        <input type="checkbox" class="checkbox checkbox-primary"
                                            name="is_visible_to_client" id="is_visible_to_client" value="1"
                                            {{ old('is_visible_to_client', $isVisibleToClient) ? 'checked' : '' }}
                                            class="checkbox" />
                                        <span class="label-text text-base"> Make visible for client </span>
                                    </label>
                                </li>
                            </ul>
                        @endif
                        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
                            {{-- First Name --}}
                            <x-forms.input-group label="Title" class="w-full" name="title"
                                value="{{ old('title') }}" :errors="$errors" required minlength="5" />
                        </div>

                        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
                            {{-- Instruction --}}
                            <div class="relative w-full">
                                <textarea class="textarea textarea-filled peer bg-transparent" placeholder="" name="instruction" id="instruction">{{ old('instruction') }}</textarea>
                                <label class="textarea-filled-label" for="instruction">Write your
                                    instruction</label>
                                <span class="textarea-filled-focused"></span>
                                @error('instruction')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="exercise-list">
                            @error('exercises')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex w-full items-center justify-center gap-3 mb-5 mt-10 flex-wrap sm:flex-nowrap">
                            <button type="submit" class="btn btn-primary btn-lg ">Create workout</button>
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
