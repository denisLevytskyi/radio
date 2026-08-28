<x-l-layout::form :action="route('login')" >
    <x-slot:title>
        Вход
    </x-slot:title>
    <x-slot:header_info>
        Вход в приложение
    </x-slot:header_info>
    <x-l::form-input-error :messages="$errors->get('loginEmail')"/>
    <x-l::form-input name="loginEmail" type="text" placeholder="Email" :value="old('loginEmail')"/>
    <x-l::form-input-error :messages="$errors->get('loginPassword')"/>
    <x-l::form-input name="loginPassword" type="password" placeholder="Пароль" :value="old('loginPassword')"/>
    <x-l::form-input-check name="loginRemember">
        Запомнить меня
    </x-l::form-input-check>
    <x-l::form-btn>
        Вход
    </x-l::form-btn>
    <a href="{{ route('register') }}" class="formFormA">
        Регистрация
    </a>
    <a href="{{ route('password.request') }}" class="formFormA">
        Восстановить
    </a>
    <script>
        let text;
        const ndef = new NDEFReader();

        const php_token = '{{ csrf_token() }}';
        const php_route = '{{ route('login.nfc') }}';

        const makeFormData = () => {
            const formData = new FormData();
            formData.append('_token', php_token);
            formData.append('loginToken', text);
            formData.append('loginPin', prompt('Введите PIN:'));
            return formData;
        }

        const sendData = () => {
            const request = new XMLHttpRequest();
            const formData = makeFormData();
            request.open('POST', php_route, true);
            request.onload = () => {
                if (request.status === 200 && request.responseText === '1') {
                    location.reload();
                } else {
                    alert('Ошибка');
                }
            }
            request.onerror = () => {
                alert('Ошибка');
            }
            request.send(formData);
        }

        async function startNfc() {
            ndef.scan();
            ndef.onreading = (event) => {
                for (const record of event.message.records) {
                    if (record.recordType === "text") {
                        text = new TextDecoder(record.encoding).decode(record.data);
                    }
                }
                if (text) {
                    sendData();
                }
            }
        }

        window.onclick = async () => {
            await startNfc();
        };
    </script>
</x-l-layout::form>
