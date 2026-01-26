<table>
    <tr style="height: 30px;">
        <td colspan="4" style="text-align: center; font-weight: bold; font-size: 14px;">PRICE LIST CATALOG PT NEO DUTA
            MANDIRI</td>
    </tr>
    <tr style="height: 30px;">
        <td colspan="4" style="text-align: center; font-size: 8px;">Email : neodutamandiri@gmail.com - No Hp
            0813-9767-9070 / 082363336535</td>
    </tr>
    <tr>
        <td colspan="4"
            style="text-align: center; font-weight: bold; font-size: 9px; background-color: #59A9F2; color: black;">
            PRODUK {{ $brand->name }}</td>
    </tr>
    <tr style="height: 25px;">
        <td
            style="text-align: center; font-weight: bold; width: 150px; font-size: 8px; background-color: #0F6FC6; color: white;">
            Inventory ID</td>
        <td
            style="text-align: center; font-weight: bold; width: 300px; font-size: 8px; background-color: #0F6FC6; color: white;">
            Description</td>
        <td
            style="text-align: center; font-weight: bold; width: 100px; font-size: 8px; background-color: #0F6FC6; color: white;">
            UOM</td>
        <td
            style="text-align: center; font-weight: bold; width: 150px; font-size: 8px; background-color: #0F6FC6; color: white;">
            Harga</td>
    </tr>

    @foreach ($products as $product)
        <tr style="background-color: {{ $loop->odd ? '#C7E2FA' : '#FFFFFF' }};">
            <td>{{ $product->code }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->unit->name }}</td>
            <td>{{ number_format($product->price, 2) }}</td>
        </tr>
    @endforeach
</table>
