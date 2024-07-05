<div class="sticky top-0 z-50 border-b navbar bg-base-100 border-base-300">
    <div class="navbar-start">
        <label for="sidebar-drawer" class="btn btn-ghost btn-circle lg:hidden">
            <x-tabler-menu class="size-5" />
        </label>
    </div>
    <div class="navbar-center">
        <a href="{{ route('home') }}" class="text-xl btn btn-ghost" wire:navigate>{{ config('app.name') }}</a>
    </div>
    <div class="navbar-end">
        {{-- <a class="btn btn-ghost btn-circle" wire:navigate>
            <x-tabler-plus class="size-5" />
        </a> --}}
    </div>
</div>
