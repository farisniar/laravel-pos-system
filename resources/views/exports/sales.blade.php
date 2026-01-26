<table>
    <tr>
        <td colspan="10" style="text-align: center; font-weight: bold; color: #0070C0; font-size: 18px;">REKAPAN HUTANG
        </td>
    </tr>

    <tr style="height: 30px;">
        <td style="text-align: left; font-weight: bold; background-color: #FFE598; width: 175px;">OUTLET BELI</td>
        <td style="text-align: center; font-weight: bold; background-color: #FFE598;">TGL PEMBELIAN</td>
        <td style="text-align: center; font-weight: bold; background-color: #FFE598;">Bulan</td>
        <td style="text-align: center; font-weight: bold; background-color: #FFE598;">Jatuh tempo</td>
        <td style="text-align: center; font-weight: bold; background-color: #FFE598;">KETERANGAN</td>
        <td style="text-align: center; font-weight: bold; background-color: #FFE598;">PAYMENT PEMBELIAN</td>
        <td style="text-align: center; font-weight: bold; background-color: #FFE598;">Sum of TOTAL BELI</td>
        <td style="text-align: center; font-weight: bold; background-color: #FFE598;">Sum of TOTAL BELI + PPN</td>
        <td style="text-align: center; font-weight: bold; background-color: #FFE598;">KETERANGAN</td>
        <td style="text-align: center; font-weight: bold; background-color: white; color: #FF0000;">Total jatuh tempo
        </td>
    </tr>

    @foreach ($sales as $clientSales)
        @php
            $grandTotal = 0;
            $paidTotal = 0;
            $clientName = '';
            $rowspan = $clientSales->count();
        @endphp

        @foreach ($clientSales as $sale)
            @php
                $grandTotal += $sale->GrandTotal;
                $paidTotal += $sale->paid_amount;
                $clientName = $sale->client->name;
            @endphp

            <tr>
                @if ($loop->first)
                    <td rowspan="{{ $rowspan }}" style="vertical-align: top; font-weight: bold;">
                        {{ $sale->client->name }}
                    </td>
                @endif
                <td></td>
                <td style="text-align:center;">1</td>
                <td></td>
                <td>JATUH TEMPO</td>
                <td></td>
                <td>
                    {{ number_format($sale->details->sum('total'), 2) }}
                </td>
                <td style="font-weight: bold;">{{ number_format($sale->GrandTotal, 2) }}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach

        @php
            $due = $grandTotal - $paidTotal;
        @endphp

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight: bold; text-align: center;">Cicil</td>
            <td style="font-weight: bold; text-align: center;">{{ number_format($paidTotal, 2) }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr style="background-color: #FEF2CB;">
            <td style="font-weight: bold; background-color: #FEF2CB;" colspan="7">
                {{ $clientName }}
            </td>
            <td style="font-weight: bold; background-color: #FEF2CB;">
                {{ number_format($due, 2) }}
            </td>
            <td style="font-weight: bold; background-color: #FEF2CB;"></td>
        </tr>
    @endforeach
</table>
