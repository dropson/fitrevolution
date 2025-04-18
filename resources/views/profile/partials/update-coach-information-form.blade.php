<section>



    <form method="POST" class="max-w-2xl" action="{{ route('coach_profile.update') }}">

        @csrf
        @method('patch')


        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- Price --}}
            <x-forms.input-group label="Price" name="price" value="{{ old('price', $user->coachProfile?->price) }}"
                :errors="$errors" />
            {{-- Gender --}}
            <div class="relative w-36">
                <select class="select select-lg select-filled  bg-white" name="currency" aria-label="Filled select">
                    @foreach (App\Enums\CurrencyEnum::cases() as $index => $currency)
    
                    <option value="{{ $currency->value }}"
                        {{ old('currency', $user->coachProfile?->currency->value ?? $currency->value) === $currency->value ? 'selected' : '' }}>
                        {{ $currency->name }}
                    </option>
                    @endforeach
                    {{-- @foreach ($genders as $index => $gender)
                        <option value="{{ $gender->value }}"
                            {{ old('gender', $user->gender?->value ?? $genders[0]->value) === $gender->value ? 'selected' : '' }}>
                            {{ $gender->name }}
                        </option>
                    @endforeach --}}
                </select>
               
            </div>
        </div>

        <div class="flex w-full items-start gap-3 mb-5 flex-wrap sm:flex-nowrap">
            {{-- bio --}}
            <x-forms.input-group label="Your bio" name="bio" value="{{ old('bio', $user->coachProfile?->bio) }}"
                :errors="$errors" class="w-full" />
        </div>


        <div class="flex w-full items-center justify-center gap-3 mb-5 flex-wrap sm:flex-nowrap">
            <button type="submit" class="btn btn-primary btn-lg ">Update  </button>
        </div>
    </form>

</section>
