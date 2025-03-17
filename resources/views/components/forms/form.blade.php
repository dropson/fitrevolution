<form {{ $attributes(["class" => "bg-white p-5 rounded-xl max-w-[400px] mx-auto mt-6", "method" => "GET"]) }}>
    @if ($attributes->get('method', 'GET') !== 'GET')
        @csrf
        @method($attributes->get('method'))
    @endif

    {{ $slot }}
</form>