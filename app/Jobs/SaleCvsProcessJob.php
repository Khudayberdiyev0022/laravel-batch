<?php

namespace App\Jobs;

use App\Models\Sale;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SaleCvsProcessJob implements ShouldQueue
{
  use Queueable;
  public $data;
  public $header;
  /**
   * Create a new job instance.
   */
  public function __construct($data, $header)
  {
    $this->data = $data;
    $this->header = $header;
  }

  /**
   * Execute the job.
   */
  public function handle(): void
  {
    foreach ($this->data as $sale) {
      $saleData = array_combine($this->header, $sale);
      Sale::create($saleData);
    }
  }
}
