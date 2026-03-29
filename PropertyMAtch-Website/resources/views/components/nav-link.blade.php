@props(['href', 'active' => false])

<a href="{{ $href }}"
   class="nav-link {{ $active ? 'text-white rounded' : 'text-black' }}"
   style="{{ $active ? 'background-color: #5038ED;' : '' }}"
   aria-current="{{ $active ? 'page' : 'false' }}">
    {{ $slot }}
</a>

