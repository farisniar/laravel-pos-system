<?php

namespace App\Exports;

use App\Models\Deposit;
use App\Models\Sale;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SalesExport implements FromView
{
  protected $sales;

  public function __construct()
  {
    $this->sales = Sale::where('payment_statut', 'partial')
      ->where('statut', 'completed')
      ->where('deleted_at', '=', null)
      ->with(['client', 'details'])
      ->get()
      ->groupBy('client_id');
  }

  public function view(): View
  {
    return view('exports.sales', [
      'sales' => $this->sales,
    ]);
  }
}
