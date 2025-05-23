<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Resources\CategoryResource;
use App\Traits\HasApiResponse;
use App\Traits\HasDateTimeFormat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  use HasApiResponse;
  use HasDateTimeFormat;

  /**
   * Display a listing of the resource.
   */
  public function index(Request $request): JsonResponse
  {
    $data = \App\Models\Category::query()
      ->when($request->input('name'), function ($query, $name) {
        $query->where('name', 'like', "%{$name}%");
      })
      ->paginate(10);

    return $this->successPagination($data , CategoryResource::collection($data));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(CategoryStoreRequest $request)
  {
    $data     = $request->validated();
    $category = \App\Models\Category::create($data);

    return response()->json($category);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
