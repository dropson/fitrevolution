<x-layout>

    <x-forms.form method="POST" action="{{ route('join.submit', $client->invitation_token) }}">


        <x-forms.title>  Please make sure we got your name or email right </x-forms.title>



        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- First Name --}}
            <x-forms.input-group label="First Name" name="first_name" value="{{ $client->user->first_name }}" :errors="$errors" />
            {{-- Last Name --}}
            <x-forms.input-group label="Last Name" name="last_name" value="{{ $client->user->last_name }}" :errors="$errors" />
        </div>

        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- Email --}}
            <x-forms.input-group label="Email" name="email" type="email" class="w-full" value="{{ $client->user->email ?? old('email') }}" :errors="$errors" />
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
            <button type="submit" class="btn btn-primary btn-lg w-full">Continue </button>
        </div>


    </x-forms.form>

</x-layout>
