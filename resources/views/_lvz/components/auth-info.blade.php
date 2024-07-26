<section class="auth">
    <div class="container typicalContainer">
        <p class="authP">
            ID: {{ Auth::user()->id }}
            Имя: {{ Auth::user()->name }}
        </p>
        <a href="{{ route('logout') }}" class="authA">
            Выйти
        </a>
        <a href="{{ route('profile.edit') }}" class="authA">
            Редактировать
        </a>
    </div>
</section>
