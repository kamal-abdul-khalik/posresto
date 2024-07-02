<div class="card-wrapper">
    <div class="max-w-lg mx-auto card">
        <form wire:submit="save" class="card-body">
            <h3 class="card-title">Edit Profile: {{ auth()->user()->name }}</h3>
            <div class="py-4 space-y-2">
                <x-input :label="'Nama Lengkap'" :type="'text'" :wire-model="'name'" :placeholder="'Nama Anda'" :error="$errors->first('name')" />
                <x-input :label="'Email'" :type="'email'" :wire-model="'email'" :placeholder="'Email Anda'" :error="$errors->first('email')" />
                <x-input :label="'Password'" :type="'password'" :wire-model="'password'" :placeholder="'Isi jika ingin mengubah password'"
                    :error="$errors->first('password')" />
            </div>
            <div class="justify-end card-actions">
                <button type="submit" class="btn btn-primary">
                    <x-tabler-check class="size-5" />
                    <span>Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>
