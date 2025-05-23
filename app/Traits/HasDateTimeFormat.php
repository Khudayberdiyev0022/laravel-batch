<?php

namespace App\Traits;

trait HasDateTimeFormat
{
  public function dateFormat($date, $format = 'Y-m-d'): string
  {
    return date($format, strtotime($date));
  }

  public function dateTimeFormat($date, $format = 'Y-m-d H:i:s'): string
  {
    return date($format, strtotime($date));
  }
}
