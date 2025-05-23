<?php

namespace App\Models;

use App\Traits\HasApiResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'status'];
}
