@props(['user', 'size' => 100, 'fontSize' => 40])

@php
$sizeStyle = "width: {$size}px; height: {$size}px;";
$fontSizeStyle = "font-size: {$fontSize}px;";
@endphp

@if($user->profile_image)
    <img src="{{ asset('storage/' . $user->profile_image) }}" 
         class="rounded-circle profile-image" 
         alt="{{ $user->name }}"
         style="{{ $sizeStyle }} object-fit: cover;">
@else
    <div class="rounded-circle profile-image d-flex justify-content-center align-items-center text-decoration-none" 
         style="{{ $sizeStyle }} background-color: #b75959; color: white; {{ $fontSizeStyle }} font-weight: bold; border: none; outline: none; text-decoration: none;">
        {{ strtoupper(substr($user->name, 0, 1)) }}
    </div>
@endif