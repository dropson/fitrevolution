<x-layout>

    @section('subheader')
        @include('layouts.partials.client-subheader', ['client' => $client])
    @endsection

    <x-workouts.create-form
        :route-prefix="$routePrefix"
        :route-params="['client' => $client]"
        :exercises="$exercises"
    />

</x-layout>
