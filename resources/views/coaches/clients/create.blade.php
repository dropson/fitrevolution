<x-layout>


    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Client Information
        </h2>
    </div>

    <div class="py-5">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="max-w-xl">
                    <form method="POST" class="max-w-2xl" action="{{ route('coaches.clients.store') }}">

                        @csrf

                        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
                            {{-- First Name --}}
                            <x-forms.input-group label="First Name" name="first_name"
                                value="{{ old('first_name') }}" :errors="$errors" />
                            {{-- Last Name --}}
                            <x-forms.input-group label="Last Name" name="last_name"
                                value="{{ old('last_name') }}" :errors="$errors" />
                            {{-- Gender --}}
                        </div>

                        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
                            {{-- Gender --}}
                            <div class="relative w-36">
                                <select class="select select-lg select-filled  bg-white" name="gender"
                                    aria-label="Filled select">
                                    @foreach (App\Enums\UserGenderEnum::cases() as $index => $gender)
                                        <option value="{{ $gender->value }}"
                                            {{ old('gender') === $gender->value ? 'selected' : '' }}>
                                            {{ $gender->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="select-filled-focused"></span>
                                <label class="select-filled-label" for="selectFilledLarge">Gender</label>
                            </div>
                        </div>


                        <div class="flex w-full items-center justify-center gap-3 mb-5 flex-wrap sm:flex-nowrap">
                            <button type="submit" class="btn btn-primary btn-lg ">Create client </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>