@extends('admin.layouts.app')
@section('title', '添加设置')
@section('main')
<main class="app-main"> <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">添加设置</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="/admin/setting">设置</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            添加设置
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row g-4"> <!--begin::Col-->
                <!--begin::Col-->
                <div class="col-md-12"> <!--begin::Quick Example-->
                    <div class="card card-warning card-outline mb-4"> <!--begin::Header-->
                        <form> <!--begin::Body-->
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">名称</label>
                                    <div class="col-sm-10"> <input type="text" class="form-control" id="inputEmail3"> </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">键名</label>
                                    <div class="col-sm-10"> <input type="text" class="form-control" id="inputEmail3"> </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">键值</label>
                                    <div class="col-sm-10"> <input type="text" class="form-control" id="inputEmail3"> </div>
                                </div>
                            </div> <!--end::Body--> <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">确认</button>
                                <button type="submit" class="btn float-end">取消</button>
                            </div> <!--end::Footer-->
                        </form> <!--end::Form-->
                    </div> <!--end::Horizontal Form-->
                </div> <!--end::Col--> <!--begin::Col-->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main> <!--end::App Main--> <!--begin::Footer-->
@endsection
