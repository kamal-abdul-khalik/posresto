<div>
    <input type="checkbox" class="modal-toggle" @checked($showModalForm) />
    <div class="modal" role="dialog">
        <form class="modal-box" wire:submit="save">
            <h3 class="text-lg font-bold">Form Input Pelanggan</h3>
            <div class="py-4 space-y-2">
                <x-input :label="'Nama Pelanggan'" :type="'text'" :wire-model="'form.name'" :placeholder="'Ketikkan nama pelanggan'" :error="$errors->first('form.name')" />
                <x-input :label="'Kontak'" :type="'text'" :wire-model="'form.contact'" :placeholder="'Nomor kontak pelanggan'" :error="$errors->first('form.contact')" />
                <x-textarea :label="'Keterangan'" :wire-model="'form.desc'" :placeholder="'Ketikkan keterangan'" :error="$errors->first('form.desc')"></x-textarea>
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
