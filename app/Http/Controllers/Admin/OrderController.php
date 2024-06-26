<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer_title = request()->customer_title ?? false;
        $limit = request()->limit ?? 10;
        $orders = Order::when($customer_title, function ($query) use ($customer_title) {
            $query->where('customer_title', 'like', "%$customer_title%");
        })->where('is_deleted', 0)->orderBy('id', 'desc')->paginate($limit);
        return response()->json([
            'code' => 20000,
            'status' => 'success',
            'message' => 'list product',
            'data' => $orders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'customer_title' => 'required',
                'delivery_address_name' => 'required',
                'delivery_address_phone' => 'required',
                'delivery_address_province' => 'required',
                'delivery_address_city' => 'required',
                'delivery_address_district' => 'required',
                'delivery_address_detail' => 'required',
                'products' => 'required|array',
                'products.*.id' => 'required',
                'products.*.title' => 'required',
                'products.*.specification' => 'required',
                'products.*.quantity' => 'required',
                'products.*.price' => 'required',
                'products.*.total_price' => 'required',
                'total_price' => 'required',
                'status' => 'required', //订单状态 0 待支付 1 已支付 2 已取消 3 已完成
                'delivery_method' => 'required', //配送方式 0 快递 1 自取 2 送货上门
                'payment_method' => 'required', //支付方式 0 支付宝 1 微信 2 银行卡
                'payment_status' => 'required', //支付状态 0 待支付 1 已支付 2 支付失败
            ]);
            Db::beginTransaction();

            $request->merge([
                'order_no' => 'abd123123'
            ]);
            $order = Order::create($request->all());
            $products = $request->products;
            for ($i=0; $i < count($products); $i++) {
                $products[$i]['order_id'] = $order->id;
                $products[$i]['order_no'] = $order->order_no;
                $products[$i]['product_id'] = $products[$i]['id'];
                unset($products[$i]['id']);
            }
            $order->products()->createMany($products);
            Db::commit();
            return response()->json([
                'code' => 20000,
                'message' => 'success'
            ]);

        } catch (\Throwable $th) {
            Db::rollBack();
            return response()->json([
                'code' => 50000,
                'message' => 'error',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //订单详情
        $order = Order::with('products')->find($id);
        return response()->json([
            'code' => 20000,
            'status' => 'success',
            'message' => 'list product',
            'data' => $order
        ]);
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
        $order = Order::find($id);
        $order->delete();
        return response()->json([
            'code' => 20000,
            'status' => 'success',
            'message' => 'delete order',
            'data' => $order
        ]);

    }
}
