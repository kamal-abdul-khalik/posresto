<div class="w-full max-w-sm shadow-2xl card bg-base-100 shrink-0">
    <form wire:submit="login" class="card-body">
        <h3 class="text-xl font-bold">Selamat Datang</h3>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Email</span>
            </label>
            <input type="email" wire:model="email" placeholder="email" @class([
                'flex items-center gap-2 input input-bordered',
                'input-error' => $errors->first('email'),
            ])>
            @error('email')
                <span class="mt-1 text-xs text-error">{{ $errors->first('email') }}</span>
            @enderror
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Password</span>
            </label>
            <input type="password" wire:model="password" placeholder="password" @class([
                'flex items-center gap-2 input input-bordered',
                'input-error' => $errors->first('password'),
            ])>
            @error('password')
                <span class="mt-1 text-xs text-error">{{ $errors->first('password') }}</span>
            @enderror
        </div>
        <div class="mt-6 form-control">
            <button class="btn btn-primary">
                <x-tabler-login class="size-5" />
                <span>Login</span>
            </button>
        </div>
    </form>
</div>
