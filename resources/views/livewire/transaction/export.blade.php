<div class="page-wrapper">
    <div class="max-w-xl mx-auto">
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
                <form class="flex justify-between card-actions" wire:submit="export">
                    <input type="month" @class([
                        'input input-bordered',
                        'input-error' => $errors->first('month'),
                    ]) class="form-control" wire:model="month">
                    <button wire:click="export" class="btn btn-primary">
                        <x-tabler-download class="size-4" />
                        <span>Download</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
