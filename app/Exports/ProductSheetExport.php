<?php

namespace App\Exports;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductSheetExport implements FromView, WithTitle
{
  private $brandId;
  protected $brand;
  protected $products;

  public function __construct(int $brandId)
  {
    $this->brandId = $brandId;

    $this->brand = Brand::find($this->brandId);

    $this->products = Product::with(['unit', 'category', 'brand'])
      ->when($this->brandId, function ($query) {
        $query->where('brand_id', $this->brandId);
      })
      ->where('deleted_at', '=', null)
      ->get();
  }

  public function title(): string
  {
    return $this->brand->name;
  }

  public function view(): View
  {
    return view('exports.product', [
      'brand' => $this->brand,
      'products' => $this->products,
    ]);
  }
}
