<table>
    <thead>
        <tr>
            <th>Kode</th>
            <th>Waktu</th>
            <th>Keterangan</th>
            <th>Pelanggan</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->created_at->format('d F Y') }}</td>
                <td>{{ $transaction->desc }}</td>
                <td>{{ $transaction->customer->name ?? '-' }}</td>
                <td>{{ $transaction->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
