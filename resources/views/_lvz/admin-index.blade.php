<x-l-layout::main>
    <x-slot:title>
        Список пользователей
    </x-slot:title>
    <x-slot:header_info>
        Список пользователей
    </x-slot:header_info>
    <section class="list">
        <div class="container typicalContainer">
            <a href="{{ route('app.admin.create') }}" class="listA">
                Добавить пользователя
            </a>
            <div class="listWrap">
                @foreach($users as $user)
                <div class="listWrapItem">
                    <a href="{{ route('app.admin.edit', $user->id) }}" class="listWrapItemA">
                        {{ $user->id . ' ' . $user->email . ' ' . $user->name }}
                    </a>
                </div>
                @endforeach
                {{ $users->onEachSide(1)->links() }}
            </div>
        </div>
    </section>
</x-l-layout::main>
