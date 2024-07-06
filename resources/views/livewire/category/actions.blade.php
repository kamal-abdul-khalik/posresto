<div>
    <input type="checkbox" class="modal-toggle" @checked($showModalCategory) />
    <div class="modal" role="dialog">
        <form class="modal-box" wire:submit="save">
            <h3 class="text-lg font-bold">Form Input Kategori Menu</h3>
            <div class="py-4 space-y-2">
                <x-input :label="'Nama Kategory'" :type="'text'" :wire-model="'form.name'" :placeholder="'Ketikkan nama kategori'" :error="$errors->first('form.name')" />
            </div>
            <div class="flex justify-between modal-actions">
                <button type="button" class="btn btn-ghost btn-sm" wire:click="closeModal">
                    <x-tabler-x class="size-4" />
                    <span>Batal</span>
                </button>
                <button class="btn btn-primary btn-sm">
                    <x-tabler-check class="size-4" />
                    <span>Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>
