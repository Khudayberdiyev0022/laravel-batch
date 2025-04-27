<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
  public function index()
  {
    return view('upload');
  }

  public function upload()
  {
    if (request()->hasFile('file')) {
//      $data   = array_map('str_getcsv', file(request('file')));
      $data   = file(request('file'));
//      $header = $data[0];

//      unset($data[0]);
      // Chunking file
      $chunks = array_chunk($data, 1000);

      // Convert 1000 records into a new csv file
      foreach ($chunks as $key => $chunk) {
        $name = "/tmp{$key}.csv";
        $path = resource_path('temp');
//        return $path.$name;
        file_put_contents($path.$name, $chunk);
      }
//      dd($chunks[0]);
//      foreach ($data as $value) {
//        $saleData = array_combine($header, $value);
//        Sale::create($saleData);
//      }
    }

    return back();
  }

  public function store()
  {
    $path  = resource_path('temp');
    $files = glob($path."/*.csv");
//    return $files;
    $header = [];
    foreach ($files as $key => $file) {
      $data = array_map('str_getcsv', file($file));
      if ($key === 0) {
        $header = $data[0];
        unset($data[0]);
      }

      foreach ($data as $sale) {
        $saleData = array_combine($header, $sale);
        Sale::create($saleData);
      }
      unlink($file);
    }
    return 'Success';
  }
}
