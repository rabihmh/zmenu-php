<!-- resources/views/components/input-a.blade.php -->
@props(['name', 'type' => 'text', 'placeholder' => '', 'required' => false])

<input class="form-control form-control-user" placeholder="{{ $placeholder }}" type="{{ $type }}" name="{{ $name }}"
       value="{{ old($name) }}" @if($required) required @endif {{ $attributes }}>
@error($name)
<span class="text-danger mt-2 ml-2">{{ $message }}</span>
@enderror
