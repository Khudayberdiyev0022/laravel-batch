<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Resources\PostResource;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
  use HasApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = \App\Models\Post::query()
          ->with('category')
          ->when(request('search'), function ($query) {
            $query->where('title', 'like', "%".request('search')."%")
            ->orWhere('body', 'like', "%".request('search')."%");
          })
          ->when(request('category_id'), function ($query) {
            $query->where('category_id', request('category_id'));
          })
          ->when(request('status'), function ($query) {
            $query->where('status', request('status'));
          })
          ->orderBy('id', 'desc')
          ->paginate($request->input('per_page', 10));

        return $this->successPagination($data , PostResource::collection($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        //
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
