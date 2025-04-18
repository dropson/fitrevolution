<section>



    <form method="POST" class="max-w-2xl" action="{{ route('client_profile.update') }}">

        @csrf
        @method('patch')


        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- Weight --}}
            <div class="flex items-center">
                <x-forms.input-group label="Weight" name="weight"
                    value="{{ old('weight', $user->clientProfile?->weight) }}" :errors="$errors" />
                <span class="badge p-4"> kg</span>
            </div>
            {{-- Height --}}
            <div class="flex items-center">
                <x-forms.input-group label="Height" name="height"
                    value="{{ old('height', $user->clientProfile?->height) }}" :errors="$errors" />
                <span class="badge p-4"> cm</span>
            </div>
        </div>

        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
             {{-- Goal --}}
            <x-forms.input-group label="Your goal" name="goal" value="{{ old('goal', $user->clientProfile?->goal) }}"
                :errors="$errors" class="w-full" />
        </div>


        <div class="flex w-full items-center justify-center gap-3 mb-5 flex-wrap sm:flex-nowrap">
            <button type="submit" class="btn btn-primary btn-lg ">Update </button>
        </div>
    </form>

</section>
