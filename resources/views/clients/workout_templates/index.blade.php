<x-layout>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <span></span>
            <a href="{{ route($routePrefix . '.workout_templates.create') }}" class="btn btn-primary">+ Create Workout</a>
        </div>

        <div class="mt-5">
            <div class="card min-h-screen">
                <div class="card-body">
                    <div class="grid grid-cols-4 gap-7 ">
                        @forelse ($workouts as $workout)
                            <x-workout-card :workout="$workout" :route-prefix="$routePrefix" />
                        @empty
                            <p class="font-bold text-2xl text-primary col-span-4 text-center"> No Workouts </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-layout>
