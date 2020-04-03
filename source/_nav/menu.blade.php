@php $level = $level ?? 0 @endphp

<ul class="list-none my-0 {{ $level > 0 && count($items) > 1 ? 'border-l-4 border-grey-200' : null }}">
    @foreach ($items as $label => $item)
        @include('_nav.menu-item')
    @endforeach
</ul>
