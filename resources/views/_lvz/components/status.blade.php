@if ($message)
    <section class="status">
        <div class="container typicalContainer">
            <p {{ $attributes }} class="statusP">
                @lang($message)
            </p>
        </div>
    </section>
@endif
