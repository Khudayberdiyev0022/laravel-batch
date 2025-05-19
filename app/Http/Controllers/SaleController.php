<?php

namespace App\Http\Controllers;

use App\Jobs\SaleCvsProcessJob;
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
      $data = file(request('file'));
//      $header = $data[0];

//      unset($data[0]);
      // Chunking file
      $chunks = array_chunk($data, 1000);

      // Convert 1000 records into a new csv file
      $path = resource_path('temp');
      foreach ($chunks as $key => $chunk) {
        $name = "/tmp{$key}.csv";
//        return $path.$name;
        file_put_contents($path.$name, $chunk);
      }
      $files = glob($path."/*.csv");

      $header = [];
      foreach ($files as $key => $file) {
        $data = array_map('str_getcsv', file($file));
        if ($key === 0) {
          $header = $data[0];
          unset($data[0]);
        }
        SaleCvsProcessJob::dispatch($data, $header);
        unlink($file);

        return 'Stored';
      }

      return 'Done!';
    }

    return 'Please upload a file';
  }

}
