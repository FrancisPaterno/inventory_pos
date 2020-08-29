@extends('pages.masterfiles.transactions.stock.show')

@section('styles_item')
    <!--begin::Page Vendors Styles(used by this page)-->
<meta name="csrf-token" content="{{ csrf_token()}}">
<link href="/plugins/custom/datatables/datatables.bundle.css?v=7.0.4" rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles-->
@endsection

@section('content_item')
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-psd text-primary"></i>
            </span>
            <h3 class="card-label">{{$card_title??''}}</h3>
        </div>
        <div class="card-toolbar">
            <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="la la-download"></i>Export</button>
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <ul class="nav flex-column nav-hover">
                        <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">Choose an option:</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon la la-print"></i>
                                <span class="nav-text">Print</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon la la-copy"></i>
                                <span class="nav-text">Copy</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon la la-file-excel-o"></i>
                                <span class="nav-text">Excel</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon la la-file-text-o"></i>
                                <span class="nav-text">CSV</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon la la-file-pdf-o"></i>
                                <span class="nav-text">PDF</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--begin::Button-->
            <a href="/stockItems/{{$stockHeader->id}}/create" class="btn btn-primary font-weight-bolder">
                <i class="la la-plus"></i>New Record</a>
            <!--end::Button-->
            <!-- Modal-->
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Wholesale Price</th>
                    <th>Retail Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($stockHeader->stockItems as $item)
                   <tr>
                   <td>{{$item->item->name}}</td>
                   <td>{{$item->description}}</td>
                   <td>{{$item->Qty}}</td>
                   <td>{{$item->wholesale_price}}</td>
                   <td>{{$item->retail_price}}</td>
                   <td nowrap="nowrap">{{$item->id}}</td>
                   </tr>
               @endforeach
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
@endsection

@section('scripts_item')
<script src="/plugins/custom/datatables/datatables.bundle.js?v=7.0.4"></script>
<script src="/js/pages/masterfiles/transactions/stockitems/stockItem.js?v=7.0.4"></script>
<script src="/js/ajaxSetup.js?v=7.0.4"></script>
@endsection