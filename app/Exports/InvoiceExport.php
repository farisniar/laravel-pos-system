<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Sale;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoiceExport implements FromView
{
  protected $invoices;

  public function __construct($id = null)
  {
    $sale = Sale::with('details.product.unitSale')
      ->with('client')
      ->with('details')
      ->where('deleted_at', '=', null)
      ->findOrFail($id);

    $invoice = [
      'ref' => $sale->Ref,

      'date' => date('d F Y', strtotime($sale->date)),
      'due_date' => date('d F Y', strtotime($sale->due_date)),
      'payment_status' => $sale->payment_statut,

      'client' => [
        'name'  => $sale->client->name,
        'address' => $sale->client->adresse,
        'city' => $sale->client->city,
        'npwp' => $sale->client->tax_number,
      ],
    ];

    $details = [];

    foreach ($sale->details as $detail) {
      if ($detail->sale_unit_id !== null) {
        $unit = Unit::where('id', $detail->sale_unit_id)->first();
      } else {
        $product_unit_sale_id = Product::with('unitSale')
          ->where('id', $detail->product_id)
          ->first();

        if ($product_unit_sale_id['unitSale']) {
          $unit = Unit::where('id', $product_unit_sale_id['unitSale']->id)->first();
        }
        $unit = null;
      }

      if ($detail->product_variant_id) {
        $productsVariants = ProductVariant::where('product_id', $detail->product_id)
          ->where('id', $detail->product_variant_id)->first();

        $data['code'] = $productsVariants->code;
        $data['name'] = '[' . $productsVariants->name . ']' . $detail['product']['name'];
      } else {
        $data['code'] = $detail['product']['code'];
        $data['name'] = $detail['product']['name'];
      }

      $data['quantity'] = $detail->quantity;
      $data['total_price'] = $detail->total;
      $data['price'] = $detail->price;
      $data['unit_sale'] = $unit ? $unit->ShortName : '';
      $data['expired'] = '';

      if ($detail->discount_method == '2') {
        $data['DiscountNet'] = $detail->discount;
      } else {
        $data['DiscountNet'] = $detail->price * $detail->discount / 100;
      }

      $tax_price = $detail->TaxNet * (($detail->price - $data['DiscountNet']) / 100);
      $data['Unit_price'] = $detail->price;
      $data['discount'] = $detail->discount;

      if ($detail->tax_method == '1') {
        $data['Net_price'] = $detail->price - $data['DiscountNet'];
        $data['taxe'] = $tax_price;
      } else {
        $data['Net_price'] = ($detail->price - $data['DiscountNet'] - $tax_price);
        $data['taxe'] = $detail->price - $data['Net_price'] - $data['DiscountNet'];
      }

      $data['is_imei'] = $detail['product']['is_imei'];
      $data['imei_number'] = $detail->imei_number;

      $details[] = $data;
    }

    $invoice['items'] = $details;
    $invoice['tax_rate'] = $sale->tax_rate;
    $invoice['tax_net'] = number_format($sale->TaxNet, 2, '.', '');
    $invoice['sub_amount'] = number_format($sale->details->sum('total'), 2, '.', '');
    $invoice['total_amount'] = number_format($sale->paid_amount, 2, '.', '');

    $this->invoices = $invoice;
  }

  public function view(): View
  {
    return view('exports.invoice', [
      'invoices' => $this->invoices,
    ]);
  }
}
