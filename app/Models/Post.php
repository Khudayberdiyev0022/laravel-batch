<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;
  protected $fillable = ['category_id', 'title', 'body', 'status'];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }
}
