<div class="page-wrapper">
    <div class="mx-auto max-w-xl">
        <div class="divide-y-2 card">
            <div class="space-y-4 card-body">
                <h3 class="card-title">Download Transaksi</h3>
                <p>Untuk me ndownload data transaksi dalam bentuk <span class="font-semibold">spreadsheet
                        (xlsx)</span>, terlebih dahulu pilih bulan
                    transaksi yang diinginkan, kemudian
                    klik tombol download
                </p>
            </div>
            <div class="card-body">
                <form class="flex flex-col gap-4 card-actions" wire:submit="export">
                    <div>
                        <label for="month" class="label">Pilih Bulan</label>
                        <input 
                            type="month" 
                            id="month"
                            wire:model="month"
                            @class([
                                'input input-bordered w-full',
                                'input-error' => $errors->first('month'),
                            ])
                        >
                        @error('month')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary">
                            <x-tabler-download class="size-4" />
                            <span>Download</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
