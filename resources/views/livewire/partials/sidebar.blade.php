<ul class="z-50 w-64 min-h-full p-4 space-y-1 border-r menu bg-base-100 text-base-content border-base-300">
    <x-user />
    <li>
        <a href="{{ route('home') }}" wire:navigate @class(['active' => Route::is('home')])>
            <x-tabler-dashboard class="size-5" />
            Home
        </a>
    </li>
    @can('create transactions')
        <li>
            <a href="{{ route('transaction.create') }}" wire:navigate @class(['active' => Route::is('transaction.create')])>
                <x-tabler-cash-register class="size-5" />
                Input Transaksi
            </a>
        </li>
    @endcan
    <li>
        <details open>
            <summary>
                <x-tabler-category class="size-5" />
                Data Master
            </summary>
            <ul>
                @can('index menus')
                    <li>
                        <a href="{{ route('menus.index') }}" wire:navigate @class(['active' => Route::is('menus.index')])>Menu</a>
                    </li>
                @endcan
                @can('index categories')
                    <li>
                        <a href="{{ route('categories.index') }}" wire:navigate @class(['active' => Route::is('categories.index')])>Kategori</a>
                    </li>
                @endcan
                @can('index customers')
                    <li>
                        <a href="{{ route('customers.index') }}" wire:navigate @class(['active' => Route::is('customers.index')])>Pelanggan</a>
                    </li>
                @endcan
                @can('index transactions')
                    <li>
                        <a href="{{ route('transaction.index') }}" wire:navigate @class([
                            'active' => Route::is(['transaction.index', 'transaction.export']),
                        ])>
                            Riwayat Transaksi
                        </a>
                    </li>
                @endcan
            </ul>
        </details>
    </li>
    <li>
        <a href="{{ route('profile') }}" wire:navigate @class(['active' => Route::is('profile')])>
            <x-tabler-user-edit class="size-5" />
            Edit Profil
        </a>
    </li>
    <li>
        <details open>
            <summary class="text-error">
                <x-tabler-recycle class="size-5" />
                Restore
            </summary>
            <ul>
                @can('restore menus')
                    <li>
                        <a href="{{ route('restore-menus.index') }}" wire:navigate @class(['active' => Route::is('restore-menus.index')])>Menu</a>
                    </li>
                @endcan
                @can('index categories')
                    <li>
                        <a href="{{ route('categories.index') }}" wire:navigate @class(['active' => Route::is('categories.index')])>Kategori</a>
                    </li>
                @endcan
                @can('index customers')
                    <li>
                        <a href="{{ route('customers.index') }}" wire:navigate @class(['active' => Route::is('customers.index')])>Pelanggan</a>
                    </li>
                @endcan
                @can('index transactions')
                    <li>
                        <a href="{{ route('transaction.index') }}" wire:navigate @class([
                            'active' => Route::is(['transaction.index', 'transaction.export']),
                        ])>
                            Transaksi
                        </a>
                    </li>
                @endcan
            </ul>
        </details>
    </li>
</ul>
