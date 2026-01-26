<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use App\Exports\InvoiceExport;
use App\Exports\ProductExport;
use App\Exports\WarehouseExport;
use Maatwebsite\Excel\Facades\Excel;

class CustomReportController extends BaseController
{
  public function invoiceExcel($id)
  {
    return Excel::download(
      new InvoiceExport($id),
      'INV-' . str_pad($id, 3, '0', STR_PAD_LEFT) . ' MASTER.xlsx'
    );
  }

  public function warehouseExcel()
  {
    return Excel::download(
      new WarehouseExport,
      'STOK GUDANG ' . strtoupper(date('d M Y')) . '.xlsx'
    );
  }

  public function productExcel()
  {
    return Excel::download(
      new ProductExport,
      'PRICE LIST PRODUK PT NEO DUTA MANDIRI ' . strtoupper(date('Y')) . '.xlsx'
    );
  }

  public function salesExcel()
  {
    return Excel::download(
      new SalesExport,
      'REKAP HUTANG PIUTANG  UPDATE ' . strtoupper(date('Y')) . '.xlsx'
    );
  }
}
