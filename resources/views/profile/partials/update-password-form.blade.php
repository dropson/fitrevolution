<section>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

         <x-forms.input-group label="Current Password" type="password" name="current_password" :errors="$errors->updatePassword" />

         <x-forms.input-group label="New Password" type="password" name="password" :errors="$errors->updatePassword" />

         <x-forms.input-group label="Confirm Password" type="password" name="password_confirmation" :errors="$errors->updatePassword" />

            <div class="flex w-full items-center justify-center gap-3 mb-5 flex-wrap sm:flex-nowrap">
                <button type="submit" class="btn btn-primary btn-lg ">Update password </button>
            </div>

    </form>
</section>
