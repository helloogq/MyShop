<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = request()->title ?? false;
        $limit = request()->limit ?? 10;
        $is_supplier = request()->is_supplier ?? 0;
        $customers = Customer::where('is_supplier', $is_supplier)->when($title, function ($query) use ($title, $is_supplier) {
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

        $params = $request->all();
        //检查记录是否已存在
        if (Customer::where('title', $params['title'])->exists()) {
            {
                return response()->json([
                    'code' => 20001,
                    'status' => 'error',
                    'message' => 'title already exists'
                ]);
            }

            $customer = new Customer();
            $customer->title = $request->title;
            $customer->contact = $request->contact;
            $customer->contact_phone = $request->contact_phone;
            $customer->contact_address = $request->contact_address;
            $customer->is_supplier = $request->is_supplier ?? 0;
            if ($customer->save()) {
                return response()->json([
                    'code' => 20000,
                    'status' => 'success',
                    'message' => 'store success',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'store error'
                ]);
            }
        }
    }

        /**
         * Display the specified resource.
         */
        public
        function show(string $id)
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
        public
        function update(Request $request)
        {
            $customer = Customer::find($request->id);
            $customer->title = $request->title;
            $customer->contact = $request->contact;
            $customer->contact_phone = $request->contact_phone;
            $customer->contact_address = $request->contact_address;
            $customer->is_supplier = $request->is_supplier ?? 0;
            if ($customer->update()) {
                return response()->json([
                    'code' => 20000,
                    'status' => 'success',
                    'message' => 'update customer',
                    'data' => $customer
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'update error'
                ]);
            }
        }

        /**
         * Remove the specified resource from storage.
         */
        public
        function destroy(string $id)
        {
            //
            $customer = Customer::find($id);
            if ($customer->delete()) {
                return response()->json([
                    'code' => 20000,
                    'status' => 'success',
                    'message' => 'delete customer',
                    'data' => $customer
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'delete error'
                ]);
            }
        }
}
