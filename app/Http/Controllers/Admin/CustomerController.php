<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = request()->title ?? false;
        $limit = request()->limit ?? 10;
        $customers = Customer::when($title, function ($query) use ($title) {
            $query->where('title', 'like', "%$title%");
        })->paginate($limit);
        return response()->json([
            'code' => 20000,
            'status' => 'success',
            'message' => 'list customers',
            'data' => $customers
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        $customers = Customer::all();
        return response()->json([
            'code' => 20000,
            'status' => 'success',
            'message' => 'list customers',
            'data' => [
                'items' => $customers
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $customers = new Customer();
        $customers->title = $request->title;
        if ($customers->save()) {
            return  response()->json([
                'code' => 20000,
                'status' => 'success',
                'message' => 'store succcess',
                'data' => $customers
            ]);
        } else {
            return  response()->json([
                'status' => 'error',
                'message' => 'store error'
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
            'data' => Customer::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $customer = Customer::find($request->id);
        $customer->title = $request->title;
        if ($customer->update()) {
            return  response()->json([
                'code' => 20000,
                'status' => 'success',
                'message' => 'update customer',
                'data' => $customer
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
        $customer = Customer::find($id);
        if ($customer->delete()) {
            return  response()->json([
                'code' => 20000,
                'status' => 'success',
                'message' => 'delete customer',
                'data' => $customer
            ]);
        } else {
            return  response()->json([
                'status' => 'error',
                'message' => 'delete error'
            ]);
        }
    }
}
