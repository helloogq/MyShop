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
     * 生成订单号
     */
    public function createOrderNo()
    {
        // 生成一个长度为12的随机字符串，其中字符串由数字和大写字母组成
        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $index = random_int(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return 'HY'.$randomString;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'customer_title' => 'required',
                'products.*.id' => 'required',
                'products.*.title' => 'required',
                'products.*.specification' => 'required',
                'products.*.quantity' => 'required',
                'products.*.price' => 'required',
                'products.*.total_price' => 'required',
                'total_price' => 'required'
            ]);

            $data = $request->all();
            $data['delivery_address_name'] = $request->input('delivery_address_name', '');
            $data['delivery_address_phone'] = $request->input('delivery_address_phone', '');
            $data['delivery_address_province'] = $request->input('delivery_address_province', '');
            $data['delivery_address_city'] = $request->input('delivery_address_city', '');
            $data['delivery_address_area'] = $request->input('delivery_address_area', '');
            $data['delivery_address_detail'] = $request->input('delivery_address_detail', '');
            $data['customer_title'] = $request->input('customer_title', '');
            $data['customer_phone'] = $request->input('customer_phone', '');
            $data['is_deleted'] = 0;
            $data['order_no'] = $this->createOrderNo();

            Db::beginTransaction();
            $order = Order::create($data);
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
