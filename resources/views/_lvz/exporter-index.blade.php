<x-l-layout::form action="/" >
    <x-slot:title>
        Экспортер
    </x-slot:title>
    <x-slot:header_info>
        Экспортер
    </x-slot:header_info>
    <p class="formFormP">
        Секунд до запроса
    </p>
    <x-l::form-input type="number" id="timer" readonly/>
    <a href="/" class="formFormA">
        Назад
    </a>
    <x-slot:after>
        <script>
            const php_route = '{{ route('app.exporter.store') }}';
            const php_delay = {{ (int) $prop->getProp('exporter_delay') }};

            const timerInput = document.getElementById('timer');

            let timeCurrent = 0;
            let timeLeft;

            const interval = setInterval(() => {
                timeLeft = php_delay - timeCurrent;
                timeCurrent++;
                if (timeLeft <= 0) {
                    window.location.href = php_route;
                    clearInterval(interval);
                } else {
                    timerInput.value = timeLeft;
                }
            }, 1000);
        </script>
    </x-slot:after>
</x-l-layout::form>
