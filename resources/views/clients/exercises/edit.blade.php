<x-layout>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <a href="{{ route('clients.exercises.index') }}" class="btn btn-warning">Back</a>
            <h3 class="font-bold text-black text-lg">Create Custom Exercise</h3>
        </div>



        <div class="mt-5">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('clients.exercises.update', $exercise) }}">
                        @csrf
                        @method('PATCH')
                        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
                            {{-- First Name --}}
                            <x-forms.input-group label="Title" class="w-full" name="title"
                                value="{{ $exercise->title }}" :errors="$errors" />
                            {{-- Muscle_group --}}
                            <div class="relative w-60">
                                <select class="select select-lg select-filled  bg-white" name="muscle_group"
                                    aria-label="Filled select">
                                    @foreach ($muscleGroups as $item)
                                        <option value="{{ $item->value }}"
                                            {{ old('muscle_group', $exercise->muscle_group->value) === $item->value ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <span class="select-filled-focused"></span>
                                <label class="select-filled-label" for="muscle_group">Muscle Group</label>
                            </div>
                            {{-- Equipment --}}
                            <div class="relative w-60">
                                <select class="select select-lg select-filled  bg-white" name="equipment"
                                    aria-label="Filled select">

                                    @foreach ($equipments as $item)
                                        <option value="{{ $item->value }}"
                                            {{ old('equipment', $exercise->equipment->value) === $item->value ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <span class="select-filled-focused"></span>
                                <label class="select-filled-label" for="equipment">Equipment</label>
                            </div>
                        </div>

                        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
                            {{-- Instruction --}}
                            <div class="relative w-full">
                                <textarea class="textarea textarea-filled peer bg-transparent" placeholder="" name="instruction" id="instruction">{{ $exercise->instruction }}
                                </textarea>
                                <label class="textarea-filled-label" for="instruction">Write your instruction</label>
                                <span class="textarea-filled-focused"></span>
                            </div>
                        </div>


                        <div class="flex w-full items-center justify-center gap-3 mb-5 flex-wrap sm:flex-nowrap">
                            <button type="submit" class="btn btn-primary btn-lg ">Create exercise</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</x-layout>
