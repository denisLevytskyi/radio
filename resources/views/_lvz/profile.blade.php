<x-l-layout::form :action="route('profile.update')">
    <x-slot:title>
        Профиль пользователя
    </x-slot:title>
    <x-slot:header_info>
        Профиль пользователя
    </x-slot:header_info>
    <x-slot:style>
        <link rel="stylesheet" href="{{ asset('css/lvz/profile.css') }}">
    </x-slot:style>
    @method('patch')
    <x-l::form-input-error :messages="$errors->get('profileUpdateName')"/>
    <x-l::form-input name="profileUpdateName" type="text" placeholder="Имя" :value="old('profileUpdateName', $user->name)"/>
    <x-l::form-input-error :messages="$errors->get('profileUpdateEmail')"/>
    <x-l::form-input name="profileUpdateEmail" type="text" placeholder="Email" :value="old('profileUpdateEmail', $user->email)"/>
    <x-l::form-btn>
        Обновить
    </x-l::form-btn>
    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <x-slot:before>
            <section class="form">
                <div class="container">
                    <form method="post" action="{{ route('verification.send') }}" class="formForm">
                        @csrf
                        <p class="formFormP">
                            Необходимо подтвердить email!
                        </p>
                        <x-l::form-btn>
                            Подтвердить
                        </x-l::form-btn>
                    </form>
                </div>
            </section>
        </x-slot:before>
    @endif
    <x-slot:after>
        <section class="form">
            <div class="container">
                <form method="post" action="{{ route('profile.password.update') }}" class="formForm">
                    @csrf
                    @method('put')
                    <p class="formFormP">
                        Обновление пароля
                    </p>
                    <x-l::form-input-error :messages="$errors->get('profileUpdatePasswordOld')"/>
                    <x-l::form-input name="profileUpdatePasswordOld" type="password" placeholder="Старый пароль" :value="old('profileUpdatePasswordOld')"/>
                    <x-l::form-input-error :messages="$errors->get('profileUpdatePassword')"/>
                    <x-l::form-input name="profileUpdatePassword" type="password" placeholder="Новый пароль" :value="old('profileUpdatePassword')"/>
                    <x-l::form-input-error :messages="$errors->get('profileUpdatePasswordOld_confirmation')"/>
                    <x-l::form-input name="profileUpdatePassword_confirmation" type="password" placeholder="Новый пароль" :value="old('profileUpdatePassword_confirmation')"/>
                    <x-l::form-btn>
                        Обновить пароль
                    </x-l::form-btn>
                </form>
            </div>
        </section>
        <section class="form">
            <div class="container">
                <form action="" class="formForm" id="form1">
                    <p class="formFormP">
                        Удаление учетной записи
                    </p>
                    <x-l::form-btn>
                        Удалить профиль
                    </x-l::form-btn>
                </form>
                <form method="post" action="{{ route('profile.destroy') }}" class="formForm inactive" id="form2">
                    @csrf
                    @method('delete')
                    <p class="formFormP">
                        Вы уверены, что хотите удалить свою учетную запись? После удаления вашей учетной записи все ее ресурсы и данные будут удалены без возможности восстановления. Пожалуйста, введите свой пароль, чтобы подтвердить, что вы хотите навсегда удалить свою учетную запись.
                    </p>
                    <x-l::form-input-error :messages="$errors->get('profileDeletePassword')"/>
                    <x-l::form-input name="profileDeletePassword" type="password" placeholder="Пароль" :value="old('profileDeletePassword')"/>
                    <x-l::form-btn style="background: #d32121; color: white">
                        Удалить профиль
                    </x-l::form-btn>
                </form>
            </div>
            <script>
                const form1 = document.getElementById('form1');
                const form2 = document.getElementById('form2');
                const error = @error('profileDeletePassword'){{'true'}}@else{{'false'}}@enderror;
                let answer;

                form1.addEventListener('submit', function () {
                    event.preventDefault();
                    form1.classList.add('inactive');
                    form2.classList.remove('inactive');
                });

                form2.addEventListener('submit', function () {
                    event.preventDefault();
                    let answer = confirm("Уверены?");
                    if (answer) {
                        this.submit();
                    }
                });

                if (error) {
                    form1.classList.add('inactive');
                    form2.classList.remove('inactive');
                }
            </script>
        </section>
    </x-slot:after>
</x-l-layout::form>
