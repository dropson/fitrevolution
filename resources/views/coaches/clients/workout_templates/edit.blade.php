<x-layout>

    @section('subheader')
        @include('layouts.partials.client-subheader', ['client' => $client])
    @endsection
    
    <x-workouts.edit-form :route-prefix="$routePrefix" :route-params="['client' => $client, 'template' => $workout]" :exercises="$exercises" :workout="$workout" />

</x-layout>
