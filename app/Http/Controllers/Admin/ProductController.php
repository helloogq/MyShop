<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = request()->title ?? false;
        $limit = request()->limit ?? 10;
        $products = Product::when($title, function ($query) use ($title) {
            $query->where('title', 'like', "%$title%");
        })->orderBy('id', 'desc')->paginate($limit);
        return response()->json([
            'code' => 20000,
            'status' => 'success',
            'message' => 'list product',
            'data' => $products
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        $products = Product::all();
        return response()->json([
            'code' => 20000,
            'status' => 'success',
            'message' => 'list product',
            'data' => [
                'items' => $products
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->specification = $request->specification;
        $product->unit = $request->unit;
        if ($product->save()) {
            return  response()->json([
                'code' => 20000,
                'status' => 'success',
                'message' => 'create product',
                'data' => $product
            ]);
        } else {
            return  response()->json([
                'status' => 'error',
                'message' => 'create error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return response()->json([
            'status' => 'success',
            'message' => 'show product',
            'data' => Product::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->unit = $request->unit;
        if ($product->update()) {
            return  response()->json([
                'code' => 20000,
                'status' => 'success',
                'message' => 'update product',
                'data' => $product
            ]);
        } else {
            return  response()->json([
                'status' => 'error',
                'message' => 'update error'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);
        if ($product->delete()) {
            return  response()->json([
                'code' => 20000,
                'status' => 'success',
                'message' => 'delete product',
                'data' => $product
            ]);
        } else {
            return  response()->json([
                'status' => 'error',
                'message' => 'delete error'
            ]);
        }
    }
}
