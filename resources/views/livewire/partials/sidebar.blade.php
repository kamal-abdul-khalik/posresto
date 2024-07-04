<ul class="w-64 min-h-full p-4 space-y-1 border-r menu bg-base-100 text-base-content border-base-300">
    <x-user />
    <li>
        <a href="{{ route('home') }}" wire:navigate @class(['active' => Route::is('home')])>
            <x-tabler-dashboard class="size-5" />
            Home
        </a>
    </li>
    <li>
        <a href="{{ route('transaction.create') }}" wire:navigate @class(['active' => Route::is('transaction.create')])>
            <x-tabler-file-plus class="size-5" />
            Input Transaksi
        </a>
    </li>
    <li>
        <details open>
            <summary>
                <x-tabler-category class="size-5" />
                Data Master
            </summary>
            <ul>
                <li><a href="{{ route('menus.index') }}" wire:navigate @class(['active' => Route::is('menus.index')])>Data Menu</a></li>
                <li><a href="{{ route('customers.index') }}" wire:navigate @class(['active' => Route::is('customers.index')])>Data
                        Pelanggan</a></li>
                <li><a href="{{ route('transaction.index') }}" wire:navigate @class(['active' => Route::is('transaction.index')])>Riwayat
                        Transaksi</a></li>
            </ul>
        </details>
    </li>
    <li>
        <a href="{{ route('profile') }}" wire:navigate @class(['active' => Route::is('profile')])>
            <x-tabler-settings class="size-5" />
            Edit Profil
        </a>
    </li>
    <li>
        <button wire:click="logout" class="font-semibold text-error" href="" wire:navigate
            @class(['active' => false])>
            <x-tabler-logout class="size-5" />
            Keluar
        </button>
    </li>
</ul>
