<x-layout>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <nav class="tabs tabs-bordered" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <button type="button" class="tab active-tab:tab-active " id="tabs-basic-item-1" data-tab="#tabs-basic-1"
                    aria-controls="tabs-basic-1" role="tab" aria-selected="true">
                    Custom Exercises
                </button>
                <button type="button" class="tab active-tab:tab-active active" id="tabs-basic-item-2"
                    data-tab="#tabs-basic-2" aria-controls="tabs-basic-2" role="tab" aria-selected="false">
                    Exercise Databese
                </button>
            </nav>
            <a href="/" class="btn btn-primary">+ Create custion exercise</a>
        </div>


        <div class="mt-5">
            <div class="card min-h-screen">
                <div class="card-body">

                    <div id="tabs-basic-1" class="hidden" role="tabpanel" aria-labelledby="tabs-basic-item-1">

                        <div class="grid grid-cols-3 gap-7">

                            <div
                                class="flex-1 card border-primary text-primary border bg-transparent shadow-none transition hover:bg-gray-100">
                                <div class="card-body p-3">

                                    <div class="flex w-full items-center justify-between mb-3">
                                        <img src="{{ asset('images/muscle_groups/core.png') }}" class="w-12"
                                            alt="muscle icon">
                                        <div class="flex">
                                            <div class="dropdown relative inline-flex rtl:[--placement:bottom-end]">
                                                <button id="dropdown-menu-icon" type="button"
                                                    class="dropdown-toggle btn btn-square btn-primary w-7 min-h-5 h-7"
                                                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    <span class="icon-[tabler--dots-vertical] size-4 "></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-40 text-sm"
                                                    role="menu" aria-orientation="vertical"
                                                    aria-labelledby="dropdown-menu-icon">
                                                    <li><a class="dropdown-item" href="#">Edit exercies</a></li>
                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="mb-5 text-base font-bold min-h-11">Dumbbell Pres sdfs fs fsd fsd fs ss
                                    </h4>
                                    <p class="text-sm text-black font-semibold">Chest / Kettlebell</p>
                                </div>
                            </div>

                            <div
                                class="flex-1 card border-primary text-primary border bg-transparent shadow-none transition hover:bg-gray-100">
                                <div class="card-body p-3">

                                    <div class="flex w-full items-center justify-between mb-3">
                                        <img src="{{ asset('images/muscle_groups/core.png') }}" class="w-12"
                                            alt="muscle icon">
                                        <div class="flex">
                                            <div class="dropdown relative inline-flex rtl:[--placement:bottom-end]">
                                                <button id="dropdown-menu-icon" type="button"
                                                    class="dropdown-toggle btn btn-square btn-primary w-7 min-h-5 h-7"
                                                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    <span class="icon-[tabler--dots-vertical] size-4 "></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-40 text-sm"
                                                    role="menu" aria-orientation="vertical"
                                                    aria-labelledby="dropdown-menu-icon">
                                                    <li><a class="dropdown-item" href="#">Edit exercies</a></li>
                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="mb-2.5 text-base font-bold min-h-11">Dumbbell Press</h4>
                                    <p class="text-sm text-black font-semibold">Chest / Kettlebell</p>
                                </div>
                            </div>

                            <div
                                class="flex-1 card border-primary text-primary border bg-transparent shadow-none transition hover:bg-gray-100">
                                <div class="card-body p-3">

                                    <div class="flex w-full items-center justify-between mb-3">
                                        <img src="{{ asset('images/muscle_groups/core.png') }}" class="w-12"
                                            alt="muscle icon">
                                        <div class="flex">
                                            <div class="dropdown relative inline-flex rtl:[--placement:bottom-end]">
                                                <button id="dropdown-menu-icon" type="button"
                                                    class="dropdown-toggle btn btn-square btn-primary w-7 min-h-5 h-7"
                                                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    <span class="icon-[tabler--dots-vertical] size-4 "></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-40 text-sm"
                                                    role="menu" aria-orientation="vertical"
                                                    aria-labelledby="dropdown-menu-icon">
                                                    <li><a class="dropdown-item" href="#">Edit exercies</a></li>
                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="mb-2.5 text-base font-bold min-h-11">Dumbbell Press bla lba bladsfsd
                                    </h4>
                                    <p class="text-sm text-black font-semibold">Chest / Kettlebell</p>
                                </div>
                            </div>

                            <div
                                class="flex-1 card border-primary text-primary border bg-transparent shadow-none transition hover:bg-gray-100">
                                <div class="card-body p-3">

                                    <div class="flex w-full items-center justify-between mb-3">
                                        <img src="{{ asset('images/muscle_groups/core.png') }}" class="w-12"
                                            alt="muscle icon">
                                        <div class="flex">
                                            <div class="dropdown relative inline-flex rtl:[--placement:bottom-end]">
                                                <button id="dropdown-menu-icon" type="button"
                                                    class="dropdown-toggle btn btn-square btn-primary w-7 min-h-5 h-7"
                                                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    <span class="icon-[tabler--dots-vertical] size-4 "></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-40 text-sm"
                                                    role="menu" aria-orientation="vertical"
                                                    aria-labelledby="dropdown-menu-icon">
                                                    <li><a class="dropdown-item" href="#">Edit exercies</a></li>
                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="mb-2.5 text-base font-bold min-h-11">Dumbbell Press</h4>
                                    <p class="text-sm text-black font-semibold">Chest / Kettlebell</p>
                                </div>
                            </div>

                            <div
                                class="flex-1 card border-primary text-primary border bg-transparent shadow-none transition hover:bg-gray-100">
                                <div class="card-body p-3">

                                    <div class="flex w-full items-center justify-between mb-3">
                                        <img src="{{ asset('images/muscle_groups/core.png') }}" class="w-12"
                                            alt="muscle icon">
                                        <div class="flex">
                                            <div class="dropdown relative inline-flex rtl:[--placement:bottom-end]">
                                                <button id="dropdown-menu-icon" type="button"
                                                    class="dropdown-toggle btn btn-square btn-primary w-7 min-h-5 h-7"
                                                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    <span class="icon-[tabler--dots-vertical] size-4 "></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-40 text-sm"
                                                    role="menu" aria-orientation="vertical"
                                                    aria-labelledby="dropdown-menu-icon">
                                                    <li><a class="dropdown-item" href="#">Edit exercies</a></li>
                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="mb-2.5 text-base font-bold min-h-11">Dumbbell Press</h4>
                                    <p class="text-sm text-black font-semibold">Chest / Kettlebell</p>
                                </div>
                            </div>

                            <div
                                class="flex-1 card border-primary text-primary border bg-transparent shadow-none transition hover:bg-gray-100">
                                <div class="card-body p-3">

                                    <div class="flex w-full items-center justify-between mb-3">
                                        <img src="{{ asset('images/muscle_groups/core.png') }}" class="w-12"
                                            alt="muscle icon">
                                        <div class="flex">
                                            <div class="dropdown relative inline-flex rtl:[--placement:bottom-end]">
                                                <button id="dropdown-menu-icon" type="button"
                                                    class="dropdown-toggle btn btn-square btn-primary w-7 min-h-5 h-7"
                                                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    <span class="icon-[tabler--dots-vertical] size-4 "></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-40 text-sm"
                                                    role="menu" aria-orientation="vertical"
                                                    aria-labelledby="dropdown-menu-icon">
                                                    <li><a class="dropdown-item" href="#">Edit exercies</a></li>
                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="mb-2.5 text-base font-bold min-h-11">Dumbbell Press</h4>
                                    <p class="text-sm text-black font-semibold">Chest / Kettlebell</p>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div id="tabs-basic-2" role="tabpanel" aria-labelledby="tabs-basic-item-2">
                        <form method="GET" action{{ route('clients.exercises.index') }}>
                            <div class="flex justify-between mb-5">
                                <div class="flex gap-3 items-center">

                                    <input type="text" name="title" value="{{ request('title')}}" placeholder="Write title..." class="input w-40" />

                                    <div class="w-50">
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
                                    <div class="w-55">
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
                                    <button class="btn btn-primary">Apply Filter</button>
                                    <p>{{ $exerciseCount }} <span class="font-bold">exercises</span> </p>
                        </form>
                    </div>
                    <a href="{{ route('clients.exercises.index') }}" class="btn btn-error">Clear Filter</a>

                </div>
                <div class="grid grid-cols-3 gap-7">
                    @forelse ($publicExercises as $exercise)
                        <x-exercise-card :$exercise />
                    @empty
                        No Exercies
                    @endforelse
                </div>

            </div>
        </div>
    </div>
    </div>


    </div>

</x-layout>
