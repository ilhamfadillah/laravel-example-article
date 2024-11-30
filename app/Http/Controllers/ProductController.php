<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product as Model;
use App\Models\Product;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:api')
        ];
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return Model::paginate();
    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $model = new Model();
        $model->fill($request->getAllowedInput());
        $model->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully.',
            'data' => $model
        ], 200);
    }

    /**
     * @param ProductRequest $request
     * @param Model $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, Model $model)
    {
        $model->fill($request->getAllowedInput());
        $model->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully.',
            'data' => $model
        ], 200);
    }

    /**
     * @param Model $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Model $model)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Product retrieved successfully.',
            'data' => $model
        ], 200);
    }

    /**
     * @param Model $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Model $model)
    {
        $model->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully.',
            'data' => []
        ], 200);
    }

    /**
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($uuid)
    {
        $model = Product::withTrashed()->where('uuid', $uuid)->firstOrFail();

        $model->restore();

        return response()->json([
            'status' => 'success',
            'message' => 'Product restore successfully.',
            'data' => $model
        ], 200);
    }
}
