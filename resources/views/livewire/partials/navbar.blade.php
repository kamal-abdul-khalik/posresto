<div class="border-b navbar bg-base-100 border-base-300 print:hidden">
    <div class="navbar-start">
        <label for="sidebar-drawer" class="btn btn-ghost btn-circle lg:hidden">
            <x-tabler-menu class="size-5" />
        </label>
    </div>
    <div class="navbar-center">
        <a href="{{ route('home') }}" class="text-xl btn btn-ghost" wire:navigate>{{ config('app.name') }}</a>
    </div>
    <div class="navbar-end">
        <a href="{{ route('transaction.create') }}" class="btn btn-ghost btn-circle" wire:navigate>
            <x-tabler-cash-register class="size-5" />
        </a>
    </div>
</div>
