<x-layout>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <span></span>
            <a href="{{ route('clients.workouts.create') }}" class="btn btn-primary">+ Create Workout</a>
        </div>


        <div class="mt-5">
            <div class="card min-h-screen">
                <div class="card-body">
                    <div class="grid grid-cols-4 gap-7 ">
                        <div class="card w-full h-48">
                            <div class="card-body flex p-0">
                                <div
                                    class="p-3 h-full relative rounded-md bg-indigo-600 text-white transition hover:bg-indigo-700">
                                    <div>
                                        <h3 class="font-black text-xl">Upper Body s </h3>
                                        <div class="text-xs">
                                            60 min · Abs, Arms, Chest
                                        </div>
                                        <div class="absolute left-3 bottom-1 font-semibold">
                        
                                            <div class="tooltip mr-2">
                                                <a href="/" class="tooltip-toggle flex" aria-label="Tooltip">
                                                    <span class="icon-[tabler--eye] size-7"></span>
                                                </a>
                                                <span
                                                    class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible"
                                                    role="tooltip">
                                                    <span class="tooltip-body">Preview</span>
                                                </span>
                                            </div>
                        
                                            <div class="tooltip mr-2">
                                                <a href="/" class="tooltip-toggle flex" aria-label="Tooltip">
                                                    <span class="icon-[tabler--pencil-minus] size-7"></span>
                                                </a>
                                                <span
                                                    class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible"
                                                    role="tooltip">
                                                    <span class="tooltip-body">Edit</span>
                                                </span>
                                            </div>
                        
                                            <div class="tooltip mr-2">
                                                <a href="/" class="tooltip-toggle flex" aria-label="Tooltip">
                        
                                                    <span class="icon-[tabler--copy] size-7"></span>
                                                </a>
                                                <span
                                                    class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible"
                                                    role="tooltip">
                                                    <span class="tooltip-body">Copy to new workout</span>
                                                </span>
                                            </div>
                                        </div>
                        
                                        <div class="absolute right-3 bottom-1">
                                            <div class="tooltip mr-2">
                                                <a href="/" class="tooltip-toggle flex" aria-label="Tooltip">
                                                    <span class="icon-[tabler--trash] size-7"></span>
                                                </a>
                                                <span
                                                    class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible"
                                                    role="tooltip">
                                                    <span class="tooltip-body">Delete</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @forelse ($workouts as $workout)
                        
                            <x-workout-card />
                        @empty
                            <p class="font-bold text-2xl text-primary col-span-4 text-center"> No Exercises </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-layout>
