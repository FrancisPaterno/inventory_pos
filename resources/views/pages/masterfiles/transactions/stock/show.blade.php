@extends('layout.default')

@section('styles')
<link href="/css/pages/wizard/wizard-2.css?v=7.0.4" rel="stylesheet" type="text/css" />
@yield('styles_item')
@endsection


@section('content')
<!-- Modal-->
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            {{$form_title}}
        </h3>
    </div>
    <div class="card-body">
        <div class="form-group mb-8">
            <div class="alert alert-custom alert-default" role="alert">
                <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                <div class="alert-text">
                    {{$form_description}}
                </div>
            </div>
        </div>
        <h6 class="font-weight-bolder mb-3">Delivery Receipt No:</h6>
            <div class="text-dark-50 line-height-lg">
                <div>{{$stockHeader->delivery_receipt_no}}</div>
            </div>
            <div class="separator separator-dashed my-5"></div>
            <h6 class="font-weight-bolder mb-3">Description:</h6>
            <div class="text-dark-50 line-height-lg">
                <div>{{$stockHeader->description}}</div>
            </div>
            <div class="separator separator-dashed my-5"></div>
            <h6 class="font-weight-bolder mb-3">Date:</h6>
            <div class="text-dark-50 line-height-lg">
                <div>{{$stockHeader->date}}</div>
            </div>
            <div class="separator separator-dashed my-5"></div>
            <h6 class="font-weight-bolder mb-3">Warehouse:</h6>
            <div class="text-dark-50 line-height-lg">
                <div>{{$warehouses->get($stockHeader->warehouse_id)}}</div>
            </div>
            <div class="separator separator-dashed my-5"></div>
            <h6 class="font-weight-bolder mb-3">Supplier:</h6>
            <div class="text-dark-50 line-height-lg">
                <div>{{$suppliers->get($stockHeader->supplier_id)}}</div>
            </div>
            <div class="separator separator-dashed my-5"></div>
            <h6 class="font-weight-bolder mb-3">Total:</h6>
            <div class="text-dark-50 line-height-lg">
                <div>{{$stockHeader->total}}</div>
            </div>
            <div class="separator separator-dashed my-5"></div>
    </div>

    @yield('content_item')

    <div class="card-footer">
        <div style="float: right">
            {{Form::reset('Return', ['class' => 'btn btn-light-primary', 'onclick'=>"javascript:location.href='/stockHeaders';"])}}
        </div>  
    </div>
</div>
@endsection

@section('scripts')
@yield('scripts_item')
@endsection