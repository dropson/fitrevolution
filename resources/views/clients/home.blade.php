<x-layout>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        {{-- Welcome --}}
        <div class="flex gap-5 mb-8">
            <div class="avatar placeholder">
                <div class="bg-secondary text-secondary-content w-20 rounded-3xl">
                    <span class="text-2xl uppercase"><span
                            class="font-bold">{{ Str::substr($user->first_name, 0, 1) }}</span>
                        {{ Str::substr($user->last_name, 0, 1) }}</span>
                </div>
            </div>
            <div class="flex flex-col">

                <div class="text-3xl mb-2">Hello <span class="font-bold">{{ $user->first_name }} {{ $user->last_name }}
                        !</span></div>
                <div>
                    <span class="badge badge-warning p-3 rounded-2xl py-4 font-bold">{{ $user->workout_completed_count }}
                        / {{ $user->workout_total_count }}</span>
                    Workouts completed
                </div>
            </div>
        </div>

        {{-- Workounts --}}
        <div class="flex flex-row gap-5 mb-8">
            {{-- Today --}}
            <div class="item basis-1/2 ">
                <h3 class="font-bold text-2xl mb-3 ">Today</h3>
                <div class="card w-full h-48">
                    <div class="card-body flex p-3  ">
                        @if ($todayEvent)
                            <x-home-workout-card :event="$todayEvent" />
                        @else
                            <div class="item border p-3 h-full relative rounded-md transition hover:bg-gray-100">
                                <div>
                                    <h3 class="font-black text-xl">Rest day</h3>

                                    <a href="/" class="text-sm absolute right-3 bottom-3 font-semibold link">
                                        Create
                                        workout</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- Tomorrow --}}
            <div class="item basis-1/2 ">
                <div class="flex justify-between items-center">
                    <h3 class="font-bold text-2xl mb-3">Tomorrow</h3>
                    <a href="{{ route('clients.calendar.index') }}" class="font-bold link text-sm">View Calendar</a>
                </div>
                <div class="card w-full h-48">
                    <div class="card-body flex p-3">
                        @if ($tomorrowEvent)
                            <x-home-workout-card :event="$tomorrowEvent" />
                        @else
                            <div class="item border p-3 h-full relative rounded-md transition hover:bg-gray-100">
                                <div>
                                    <h3 class="font-black text-xl">Rest day</h3>

                                    <a href="/" class="text-sm absolute right-3 bottom-3 font-semibold link">
                                        Create
                                        workout</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Progress --}}
        <div class="felx flew-wrap">
            <div class="flex mb-3 justify-between items-center">
                <h3 class="font-bold text-2xl">My progress</h3>
                <a href="/" class="font-bold link text-sm">View Progress</a>
            </div>

            <div class="grid gap-5">

                <div class="card w-full">
                    <div class="card-body flex flex-row justify-between p-4">

                        <div class="flex items-center">
                            <span class="icon-[tabler--scale-outline] size-13 text-indigo-700 "></span>
                            <div class="ml-3">
                                <h4 class="text-2xl font-bold text-black">My Weight</h4>
                                <a href="/">Set your goal</a>
                            </div>
                        </div>

                        <div class="flex items-center">

                            <div class="flex flex-col items-end mr-4">
                                <div class="font-bold text-black text-xl">
                                    74 kg
                                </div>
                                <div class="text-green-600">
                                    4 days ago
                                </div>
                            </div>

                            <a href=""
                                class="w-10 h-10 flex justify-center items-center rounded-full bg-green-600 text-white">
                                <span class="icon-[tabler--plus]"></span>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="card w-full">
                    <div class="card-body flex flex-row justify-between p-4">

                        <div class="flex items-center">
                            <span class="icon-[tabler--scale-outline] size-13 text-indigo-700 "></span>
                            <div class="ml-3">
                                <h4 class="text-2xl font-bold text-black">My Weight</h4>
                                <a href="/">Set your goal</a>
                            </div>
                        </div>

                        <div class="flex items-center">

                            <div class="flex flex-col items-end mr-4">
                                <div class="font-bold text-black text-xl">
                                    74 kg
                                </div>
                                <div class="text-green-600">
                                    4 days ago
                                </div>
                            </div>

                            <a href=""
                                class="w-10 h-10 flex justify-center items-center rounded-full bg-green-600 text-white">
                                <span class="icon-[tabler--plus]"></span>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="card w-full">
                    <div class="card-body flex flex-row justify-between p-4">

                        <div class="flex items-center">
                            <span class="icon-[tabler--scale-outline] size-13 text-indigo-700 "></span>
                            <div class="ml-3">
                                <h4 class="text-2xl font-bold text-black">My Weight</h4>
                                <a href="/">Set your goal</a>
                            </div>
                        </div>

                        <div class="flex items-center">

                            <div class="flex flex-col items-end mr-4">
                                <div class="font-bold text-black text-xl">
                                    74 kg
                                </div>
                                <div class="text-green-600">
                                    4 days ago
                                </div>
                            </div>

                            <a href=""
                                class="w-10 h-10 flex justify-center items-center rounded-full bg-green-600 text-white">
                                <span class="icon-[tabler--plus]"></span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
