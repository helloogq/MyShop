<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AreaList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    public function getChildList(Request $request) {
        $parent_id = $request->input('parent_id', 0);
        $list = Area::where('parent_id', $parent_id)->get();
        //打印最后查询sql
        return response()->json([
            "code" => 20000,
            "message" => "success",
            "data" => $list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd(123);
        $areas = Area::all();
        // 创建一个AreaList对象
        $area_list_obj = new AreaList($areas);
        $area_list = $area_list_obj->getAreaChildList(0);
        return response()->json([
            "code" => 20000,
            "message" => "success",
            "data" => $area_list
        ]);

        // Cache::forget('area_list');
        // $area_list = Cache::get('area_list');
        // if (!$area_list) {
        //     $areas = Area::all();
        //     // 创建一个AreaList对象
        //     $area_list_obj = new AreaList($areas);
        //     $area_list = $area_list_obj->getAreaChildList(0);
        //     // 缓存数据，有效期为1小时
        //     Cache::put('area_list', $area_list, 3600);
        // }
        // return response()->json([
        //     "code" => 20000,
        //     "message" => "success",
        //     "data" => $area_list
        // ]);
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
