<x-layout>

    <x-forms.form method="POST" action="{{ route('verification.send') }}">

        <x-forms.title> Thanks for signing up!</x-forms.title>
        <x-forms.sub-title> Before getting started, could you verify your email address by clicking on the link we just
            emailed to you? If you didn\'t receive the email, we will gladly send you another.</x-forms.sub-title>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 text-center">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="flex w-full items-center justify-center gap-3 mb-5 flex-wrap sm:flex-nowrap">
            <button type="submit" class="btn btn-primary btn-lg w-full">Resend Verification Email </button>
        </div>

    </x-forms.form>

</x-layout>
