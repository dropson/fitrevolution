<x-layout>

    <x-forms.form method="POST" action="{{ route('register') }}">


        <x-forms.title>Start creating workouts now! </x-forms.title>


        <div class="flex w-full items-start gap-3 mb-5 ">
            {{-- Gender --}}
            {{-- {{ dd($genders) }} --}}
            @foreach ($genders as $index => $gender)
                <x-forms.radio-group label="{{ $gender->name }}" name="gender" value="{{ $gender->value }}"
                    :checked="old('gender') ? old('gender') === $gender->value : $index === 0" class="icon-[tabler--gender-{{ $gender->value }}]" />
            @endforeach
            {{-- <x-forms.radio-group label="Male" name="gender" value="male" checked class="icon-[tabler--gender-male]" />
            <x-forms.radio-group label="Female" name="gender" value="female" class="icon-[tabler--gender-female]" /> --}}

        </div>


        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- First Name --}}
            <x-forms.input-group label="First Name" name="first_name" :errors="$errors" />
            {{-- Last Name --}}
            <x-forms.input-group label="Last Name" name="last_name" :errors="$errors" />
        </div>

        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- Email --}}
            <x-forms.input-group label="Email" name="email" type="email" class="w-full" :errors="$errors" />
        </div>

        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- Password --}}
            <x-forms.input-group label="Password" name="password" type="password" class="w-full" :errors="$errors" />
        </div>

        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- Password --}}
            <x-forms.input-group label="Confirm Password" name="password_confirmation" type="password" class="w-full"
                :errors="$errors" />
        </div>

        <div class="flex w-full items-center justify-center gap-3 mb-5 flex-wrap sm:flex-nowrap">
            <button type="submit" class="btn btn-primary btn-lg w-full">Registration </button>
        </div>

        <a class="flex justify-center underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            href="{{ route('login') }}">
            Already registered ?
        </a>

    </x-forms.form>

</x-layout>
