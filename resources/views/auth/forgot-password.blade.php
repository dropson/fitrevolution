<x-layout>

    <x-forms.form method="POST" action="{{ route('password.email') }}">
        
        <x-forms.title> Forgot your password ?</x-forms.title>
        <x-forms.sub-title>  No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</x-forms.sub-title>

        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- Email --}}
            <x-forms.input-group label="Email" name="email" type="email" class="w-full" :errors="$errors" />
        </div>

        <div class="flex w-full items-center justify-center gap-3 mb-5 flex-wrap sm:flex-nowrap">
            <button type="submit" class="btn btn-primary btn-lg w-full">Email Password Reset Link </button>
        </div>

    </x-forms.form>

</x-layout>
