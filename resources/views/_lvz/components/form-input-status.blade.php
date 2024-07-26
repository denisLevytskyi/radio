@if ($message)
    <p {{ $attributes }} class="formFormStatus">
        @lang($message)
    </p>
@endif
