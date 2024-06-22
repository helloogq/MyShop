@extends('admin.layouts.app')
@section('title', 'Setting')
@section('main')
<main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">网站设置</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                网站设置
                            </li>
                        </ol>
                    </div>
                </div> <!--end::Row-->
                <div class="row">
                    <div class="col-sm-6">
                    <a href="/admin/setting/create" class="btn btn-primary">添加设置</a>
                    </div>
                </div>
            </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->
        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th style="width: 20px">ID</th>
                                        <th>参数</th>
                                        <th>值</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="align-middle">
                                        <td>1.</td>
                                        <td>站点名称</td>
                                        <td></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>2.</td>
                                        <td>Clean database</td>
                                        <td></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>3.</td>
                                        <td>Cron job running</td>
                                        <td></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>4.</td>
                                        <td>Fix and squish bugs</td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div> <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    <li class="page-item"> <a class="page-link" href="#">&laquo;</a> </li>
                                    <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                                    <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                                    <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                                    <li class="page-item"> <a class="page-link" href="#">&raquo;</a> </li>
                                </ul>
                            </div>
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main> <!--end::App Main-->
@endsection
