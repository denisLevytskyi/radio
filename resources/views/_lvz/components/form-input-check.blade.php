<div class="formFormBox">
    <input {{ $attributes }} type="checkbox" class="formFormBoxCheck" {{ $checked ? 'checked' : '' }}>
    <p>{{ $slot }}</p>
</div>
