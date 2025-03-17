<x-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <x-forms.form method="POST" action="{{ route('login') }}">
        
        <x-forms.title> Welcome back ! </x-forms.title>

        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- Email --}}
            <x-forms.input-group label="Email" name="email" type="email" class="w-full" :errors="$errors" />
        </div>

        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- Password --}}
            <x-forms.input-group label="Password" name="password" type="password" class="w-full" :errors="$errors" />
        </div>

        <div class="flex w-full items-center justify-center gap-3 mb-5 flex-wrap sm:flex-nowrap">
            <button type="submit" class="btn btn-primary btn-lg w-full">Log in </button>
        </div>

        <a class="flex justify-center underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            href="{{ route('password.request') }}">
            Forgot your password?
        </a>

    </x-forms.form>


</x-layout>
