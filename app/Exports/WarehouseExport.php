<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\product_warehouse;
use App\Models\UserWarehouse;
use App\Models\Warehouse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class WarehouseExport implements FromView
{
  protected $warehouses;

  public function __construct()
  {
    $user_auth = Auth::user();

    if ($user_auth->is_all_warehouses) {
      $warehouses_id = Warehouse::where('deleted_at', '=', null)->pluck('id')->toArray();
    } else {
      $warehouses_id = UserWarehouse::where('user_id', $user_auth->id)->pluck('warehouse_id')->toArray();
    }

    $products = Product::with(['unit', 'category', 'brand'])
      ->where('deleted_at', '=', null)
      ->get();

    $warehouse_data = $products->map(function ($product) use ($warehouses_id) {
      $current_stock = product_warehouse::where('product_id', $product->id)
        ->where('deleted_at', '=', null)
        ->whereIn('warehouse_id', $warehouses_id)
        ->sum('qte');

      return [
        'id' => $product->id,
        'code' => $product->code,
        'name' => $product->name,
        'category' => $product['category']->name,
        'brand' => $product->brand ? $product->brand->name : 'N/D',
        'unit' => optional($product->unit)->ShortName,
        'min_price' => $product->price,
        'quantity' => $current_stock,
      ];
    });

    $this->warehouses = $warehouse_data;
  }

  public function view(): View
  {
    return view('exports.warehouse', [
      'warehouses' => $this->warehouses,
    ]);
  }
}
