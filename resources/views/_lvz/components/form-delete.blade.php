<a href="" class="formFormA" id="link">
    {{ $slot }}
</a>
<x-slot:after>
    <form action="{{ $action }}" method="Post" style="display: none" id="form">
        @csrf
        @method('delete')
    </form>
    <script>
        const link = document.getElementById('link');
        const form = document.getElementById('form');

        link.addEventListener('click', function () {
            event.preventDefault();
            let answer = confirm("Уверены?");
            if (answer) {
                form.submit();
            }
        })
    </script>
</x-slot:after>
