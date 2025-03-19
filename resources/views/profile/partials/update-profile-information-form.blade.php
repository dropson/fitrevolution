<section>



    <form method="POST" class="max-w-2xl" action="{{ route('profile.update') }}">

        @csrf
        @method('patch')


        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- First Name --}}
            <x-forms.input-group label="First Name" name="name" value="{{ old('name', $user->name) }}"
                :errors="$errors" />
            {{-- Last Name --}}
            <x-forms.input-group label="Last Name" name="last_name" :errors="$errors" />
            {{-- Gender --}}
            <div class="relative w-36">
                <select class="select select-lg select-filled  bg-white" id="selectFilledLarge"
                    aria-label="Filled select">
                    <option>Male</option>
                    <option>Female</option>
                </select>
                <span class="select-filled-focused"></span>
                <label class="select-filled-label" for="selectFilledLarge">Gender</label>
            </div>
        </div>

        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- Email --}}
            <x-forms.input-group label="Email" name="email" value="{{ old('email', $user->email) }}" type="email"
                class="w-full" :errors="$errors" />
        </div>


        <div class="flex w-full items-center justify-center gap-3 mb-5 flex-wrap sm:flex-nowrap">
            <button type="submit" class="btn btn-primary btn-lg ">Update profile </button>
        </div>
    </form>

</section>
