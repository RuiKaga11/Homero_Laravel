@props(['user', 'size' => 48])

@if($user->profile_image)
    <img src="{{ asset('storage/' . $user->profile_image) }}" 
        class="rounded-circle user-avatar {{ $attributes->get('class') }}" 
        alt="{{ $user->name }}"
        style="width: {{ $size }}px; height: {{ $size }}px; object-fit: cover; outline: none !important; {{ $attributes->get('style') }}"
        {{ $attributes->except(['class', 'style']) }}>
@else
    <div class="user-avatar-placeholder rounded-circle d-flex justify-content-center align-items-center {{ $attributes->get('class') }}"
        style="width: {{ $size }}px; height: {{ $size }}px; background-color: #{{ substr(md5($user->name), 0, 6) }}; outline: none !important; border: none !important; {{ $attributes->get('style') }}"
        {{ $attributes->except(['class', 'style']) }}>
        <span class="text-white fw-bold" style="font-size: {{ $size / 2.5 }}px; outline: none !important;">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
    </div>
@endif