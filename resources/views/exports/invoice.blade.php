<table>
    <tr>
        <td rowspan="2" colspan="2">
            <img src="{{ asset('images/pt-neo-duta-mandiri.png') }}" alt="Logo">
        </td>
        <td style="font-weight: bold; font-size: 16px; color: #2F5496;">PT. NEO DUTA MANDIRI</td>
        <td rowspan="2" colspan="6" style="font-weight: bold; font-size: 48px; color: #2F5496; text-align: right;">INVOICE</td>
    </tr>
    <tr>
        <td style="width: 300px; font-weight: bold; color: #2F5496;">Jl. Perjuangan Komplek Cellini Nomor B8<br>Tanjung Rejo,Sunggal - Kota Medan, Sumatera
            Utara</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold;">No Faktur</td>
        <td style="font-weight: bold;">{{ $invoices['ref'] }}</td>
        <td colspan="2" style="font-weight: bold;">Kepada</td>
        <td colspan="4" style="font-weight: bold;">{{ $invoices['client']['name'] }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold;">Tanggal Faktur</td>
        <td style="font-weight: bold;">{{ $invoices['date'] }}</td>
        <td colspan="2" style="font-weight: bold;">Alamat</td>
        <td colspan="4" style="font-weight: bold;">{{ $invoices['client']['address'] }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold;">Jatuh Tempo</td>
        <td style="font-weight: bold;">{{ $invoices['due_date'] }}</td>
        <td colspan="2" style="font-weight: bold;">Kota</td>
        <td colspan="4" style="font-weight: bold;">{{ $invoices['client']['city'] }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold;">SALES </td>
        <td></td>
        <td colspan="2" style="font-weight: bold;">NPWP</td>
        <td colspan="4" style="font-weight: bold;">{{ $invoices['client']['npwp'] }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold;">NO PO </td>
        <td></td>
        <td colspan="2" style="font-weight: bold;">Payment</td>
        <td colspan="4" style="font-weight: bold;">{{ $invoices['payment_status'] }}</td>
    </tr>
    <tr>
        <td colspan="9" style="font-weight: bold; text-align: center; font-size: 12px;">Faktur Penjualan</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">No </td>
        <td style="font-weight: bold; text-align: center;">Cat No</td>
        <td style="font-weight: bold; text-align: center;">Item</td>
        <td style="font-weight: bold; text-align: center;">Expired</td>
        <td colspan="2" style="font-weight: bold; text-align: center;">Qty</td>
        <td style="font-weight: bold; width: 100px;">Harga</td>
        <td style="font-weight: bold; text-align: center;">%</td>
        <td style="font-weight: bold; text-align: center; width: 100px;">Total Harga</td>
    </tr>

    @foreach ($invoices['items'] as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item['code'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['expired'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ $item['unit_sale'] }}</td>
            <td style="text-align: right;">{{ number_format($item['price'], 2) }}</td>
            <td>{{ number_format($item['taxe'], 2) }}</td>
            <td style="text-align: right;">{{ number_format($item['total_price'], 2) }}</td>
        </tr>
    @endforeach

    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>

    <tr>
        <td colspan="3" style="font-weight: bold;">Transfer Bank A/N PT NEO DUTA MANDIRI</td>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2" style="font-weight: bold; text-align: center;">Sub Ammount</td>
        <td style="font-weight: bold; text-align: right;">{{ number_format($invoices['sub_amount'], 2) }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold;">Bank BNI </td>
        <td style="font-weight: bold; text-align: left;">202302303000</td>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-weight: bold;">PPN</td>
        <td style="font-weight: bold;">{{ $invoices['tax_rate'] }}%</td>
        <td style="font-weight: bold; text-align: right;">{{ number_format($invoices['tax_net'], 2) }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold;">Bank BRI</td>
        <td style="font-weight: bold; text-align: left;">222701000393306</td>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2" style="font-weight: bold; text-align: center;">Total Ammount</td>
        <td style="font-weight: bold; text-align: right;">{{ number_format($invoices['total_amount'], 2) }}</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold;">Bank Sumut</td>
        <td style="font-weight: bold; text-align: left;">11401040002376</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
