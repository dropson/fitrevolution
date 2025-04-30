<x-layout>

    @section('subheader')
        @include('layouts.partials.client-subheader', ['client' => $client])
    @endsection

    <x-workouts.edit-form 
        :route-prefix="$routePrefix" 
        :route-params="['client' => $client, 'template' => $workout]" 
        :exercises="$exercises" 
        :workout="$workout" 
        :is-editable-by-client="$workout->is_editable_by_client"
        :is-visible-to-client="$workout->is_visible_to_client" />

</x-layout>
