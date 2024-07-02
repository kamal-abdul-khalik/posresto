<div class="card">
    <form wire:submit="login" class="card-body">
        <h3 class="text-xl font-bold">Selamat Datang</h3>
        <div class="py-4 space-y-4">
            <label @class([
                'flex items-center gap-2 input input-bordered',
                'input-error' => $errors->first('email'),
            ])>
                <x-tabler-at class="size-4" />
                <input type="email" wire:model="email" class="grow" placeholder="Email" />
            </label>
            @error('email')
                <span class="text-xs text-error">{{ $errors->first('email') }}</span>
            @enderror
            <label @class([
                'flex items-center gap-2 input input-bordered',
                'input-error' => $errors->first('password'),
            ])>
                <x-tabler-key class="size-4" />
                <input type="password" wire:model="password" class="grow" placeholder="Password" />
            </label>
            @error('password')
                <span class="text-xs text-error">{{ $errors->first('password') }}</span>
            @enderror
        </div>
        <div class="card-actions">
            <button type="submit" class="btn btn-primary">
                <x-tabler-login class=" size-5" />
                Login
            </button>
        </div>
    </form>
</div>
