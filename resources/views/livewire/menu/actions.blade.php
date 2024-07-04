<div>
    <input type="checkbox" class="modal-toggle" @checked($showModalForm) />
    <div class="modal" role="dialog">
        <form class="modal-box" wire:submit="save">
            <h3 class="text-lg font-bold">Form Input Menu</h3>
            <div class="py-4 space-y-2">
                <div class="flex justify-center tooltip" data-tip="Upload gambar">
                    <label for="pikimage" class="avatar">
                        <div class="w-24 mask mask-squircle">
                            <img src="{{ $image ? $image->temporaryUrl() : url('empty-image.png') }}" />
                        </div>
                        <input id="pikimage" type="file" wire:model="image" class="hidden" />
                    </label>
                </div>
                <x-input :label="'Nama Menu'" :type="'text'" :wire-model="'form.name'" :placeholder="'Ketikkan nama menu'" :error="$errors->first('form.name')" />
                <x-input :label="'Harga'" :type="'number'" :wire-model="'form.price'" :placeholder="'Ketikkan harga menu'" :error="$errors->first('form.price')" />
                <x-select :label="'Kategori'" :wire-model="'form.category_menu_id'" :error="$errors->first('form.category_menu_id')" :options="$categories" />
                <x-textarea :label="'Keterangan'" :wire-model="'form.desc'" :placeholder="'Ketikkan keterangan menu'" :error="$errors->first('form.desc')"></x-textarea>
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
