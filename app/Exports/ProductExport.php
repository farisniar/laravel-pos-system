<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductExport implements WithMultipleSheets
{
  protected $brands;

  public function __construct()
  {
    $this->brands = Brand::where('deleted_at', '=', null)->get();
  }

  public function sheets(): array
  {
    $sheets = [];

    foreach ($this->brands as $brand) {
      $sheets[] = new ProductSheetExport($brand->id);
    }

    return $sheets;
  }
}
