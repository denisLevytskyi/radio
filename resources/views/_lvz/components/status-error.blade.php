@if ($messages)
    @foreach ((array) $messages as $msg)
        <section class="statusError">
            <div class="container typicalContainer">
                <p {{ $attributes }} class="statusErrorP">
                    @lang($msg)
                </p>
            </div>
        </section>
    @endforeach
@endif
