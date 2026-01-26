<table>
    <tr>
        <td colspan="11" style="text-align:center; font-weight: bold; background-color: #8EAADB; font-size: 16px;">STOK BARANG GUDANG
            (BHP)</td>
    </tr>
    <tr>
        <td style="text-align:center; font-weight:bold; width: 250px;">ITEM</td>
        <td style="text-align:center; font-weight:bold; width: 130px;">MEREK</td>
        <td style="text-align:center; font-weight:bold; width: 80px;">QTY</td>
        <td style="text-align:center; font-weight:bold; width: 80px;">SATUAN</td>
        <td style="text-align:center; font-weight:bold; width: 125px;">BATCH NO/LOT</td>
        <td style="text-align:center; font-weight:bold; width: 100px;">EXPIRE</td>
        <td style="text-align:center; font-weight:bold; width: 125px;">HARGA MODAL</td>
        <td style="text-align:center; font-weight:bold; width: 125px;">DROP IN</td>
        <td style="text-align:center; font-weight:bold; width: 125px;">DATE DROP IN</td>
        <td style="text-align:center; font-weight:bold; width: 125px;">DROP OUT</td>
        <td style="text-align:center; font-weight:bold; width: 125px;">DATE DROP OUT</td>
    </tr>

    @foreach ($warehouses as $warehouse)
        <tr>
            <td>{{ $warehouse['name'] }}</td>
            <td style="text-align: center;">{{ $warehouse['brand'] }}</td>
            <td style="text-align: center;">{{ $warehouse['quantity'] }}</td>
            <td style="text-align: center;">{{ $warehouse['unit'] }}</td>
            <td></td>
            <td></td>
            <td>{{ number_format($warehouse['min_price'], 2) }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endforeach

</table>
