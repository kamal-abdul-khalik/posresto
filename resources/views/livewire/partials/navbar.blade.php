<div class="border-b navbar bg-base-100 border-base-300 print:hidden">
    <div class="navbar-start">
        <label for="sidebar-drawer" class="btn btn-ghost btn-circle lg:hidden">
            <x-tabler-menu class="size-5" />
        </label>

        <a href="{{ route('transaction.create') }}" class="hidden btn btn-ghost btn-circle lg:block" wire:navigate>
            <x-tabler-cash-register class="size-5 text-info" />
        </a>
    </div>
    <div class="navbar-center">
        <a href="{{ route('home') }}" class="text-xl btn btn-ghost" wire:navigate>{{ config('app.name') }}</a>
    </div>
    <div class="navbar-end">
        <button wire:click="logout" class="btn btn-ghost btn-circle" href="" wire:navigate>
            <x-tabler-logout class="size-5 text-error" />
        </button>
    </div>
</div>
