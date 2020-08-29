@extends('layout.default')

@section('styles')
<link href="/css/pages/forms/parsley.css?v=7.0.4" rel="stylesheet" type="text/css" />
<link href="/plugins/custom/datatables/datatables.bundle.css?v=7.0.4" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    @include('layout.partials.subheader._subheader-v1')
    <!--end::Subheader-->
    <!--begin::Entry-->

    {{Form::model($sale, ['action'=>['SaleController@store', $sale->id], 'id'=>'validate_form', 'data-parsley-validate'])}}
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="card-body">
                            <div class="form-group mb-8">
                                <div class="alert alert-custom alert-default" role="alert">
                                    <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                                    <div class="alert-text">
                                        {{$form_description}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('receipt_no', 'Receipt No', ['class'=> 'col-2 col-form-label'])}}
                                <div class="col-10">
                                    {{Form::text('receipt_no', null, ['class' => 'form-control' . ($errors->has('receipt_no')? ' is-invalid':null), 'required', 'data-parsley-length'=> '[0,20]', 'data-parsley-trigger'=>'keyup'])}}
                                    @error('receipt_no')
                                        <p class="invalid-feedback">{{$errors->first('receipt_no')}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('date', 'Date*', ['class'=> 'col-2 col-form-label'])}}
                                <div class="col-10">
                                    {{Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control' . ($errors->has('date')? ' is-invalid':null), 'required', 'data-parsley-trigger'=> 'keyup'])}} 
                                    @error('date')
                                    <p class="invalid-feedback">{{$errors->first('date')}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('customer_name', 'Customer*', ['class'=> 'col-2 col-form-label'])}}
                                <div class="col-10">
                                    <div class="typeahead">
                                        {{Form::hidden('customer_id', null, ['id' => 'customer_id'])}}
                                        {{Form::text('customer_name', null, ['class' => 'form-control' . ($errors->has('customer_name')? ' is-invalid':null), 'required', 'data-parsley-length'=> '[3,300]', 'data-parsley-trigger'=>'keyup', 'id'=>'customer_name', 'dir'=> isset( $_REQUEST['rtl'] ) && $_REQUEST['rtl'] ? 'rtl' : 'ltr', 'placeholder'=>'Customers'])}}
                                        @error('customer_name')
                                            <p class="invalid-feedback">{{$errors->first('customer_name')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('description', 'Description', ['class'=> 'col-2 col-form-label'])}}
                                <div class="col-10">
                                    {{Form::text('description', null, ['class' => 'form-control' . ($errors->has('description')? ' is-invalid':null), 'data-parsley-length'=> '[0,400]', 'data-parsley-trigger'=>'keyup'])}}
                                    @error('description')
                                        <p class="invalid-feedback">{{$errors->first('description')}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('total', 'Total*', ['class'=> 'col-2 col-form-label'])}}
                                <div class="col-10">
                                    {{Form::text('total', null, ['class' => 'form-control' . ($errors->has('total')? ' is-invalid':null), 'required', 'data-parsley-trigger'=>'keyup'])}}
                                    @error('total')
                                        <p class="invalid-feedback">{{$errors->first('total')}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-custom">
                        <!--begin::Header-->
                        <div class="card-header h-auto py-4">
                            <div class="card-title">
                                <h3 class="card-label">Cart
                                <span class="d-block text-muted pt-2 font-size-sm">selected items</span></h3>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-4">
                            <div class="form-group row my-2">
                                <label class="col-4 col-form-label">Scan Code:</label>
                                <div class="col-8">
                                    <input type="number" class="form-control"/>
                                </div>
                            </div>
                            <hr style="border-top: 1px solid #8c8b8b;"/>
                            <div class="separator"></div>
                                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                                    <thead>
                                        <tr>
                                            <th style="display: none">Barcode</th>
                                            <th>Item</th>
                                            <th style="display: none">Stock</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                </table>
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                            <a href="#" class="btn btn-primary font-weight-bold mr-2">Manage company</a>
                            <a href="#" class="btn btn-light-primary font-weight-bold">Learn more</a>
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <div class="col-xl-8">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <!--begin::Details-->
                            <div class="d-flex align-items-center flex-wrap mr-2 mt-5">
                                <!--begin::Title-->
                                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Users</h5>
                                <!--end::Title-->
                                <!--begin::Search Form-->
                                <div class="d-flex align-items-center" id="kt_subheader_search">
                                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">450 Total</span>
                                    <form class="ml-5">
                                        <div class="input-group input-group-sm input-group-solid" style="max-width: 200px">
                                            <input type="text" class="form-control" id="kt_subheader_search_form" placeholder="Search..." />
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <span class="svg-icon">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                    <!--<i class="flaticon2-search-1 icon-sm"></i>-->
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--end::Search Form-->
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Header-->

                        <div class="d-flex flex-column-fluid">
                            <div class="container mt-5 overflow-auto">
                                @php
                                    $counter = 0 ;
                                @endphp
                                @foreach ($stocks as $stock)
                                    @php
                                        $counter++;
                                        $i = $loop->iteration%3;
                                    @endphp
                                    @if($i == 1) 
                                        <div class="row">
                                    @endif 
                                        <!--begin::Col-->
                                        <div class="col-sm-4 col-sm-4 col-sm-4 col-sm-4">
                                            <!--begin::Card-->
                                            <div class="card card-custom gutter-b card-stretch">
                                                <!--begin::Body-->
                                                <div class="card-body pt-2">
                                                    <!--begin::User-->
                                                    <div class="d-flex align-items-center mb-2">
                                                        <!--begin::Pic-->
                                                        <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                                                            <div class="symbol symbol-square symbol-lg-75">
                                                                <img src="/media/users/300_10.jpg" alt="image" />
                                                            </div>
                                                            <div class="symbol symbol-lg-75 symbol-square symbol-primary d-none">
                                                                <span class="font-size-h3 font-weight-boldest">JM</span>
                                                            </div>
                                                        </div>
                                                        <!--end::Pic-->
                                                        <!--begin::Title-->
                                                        <div class="d-flex flex-column">
                                                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">{{$stock->item->name}}</a>
                                                        <span class="text-muted font-weight-bold">{{$stock->item->itemBrand->name}}</span>
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::User-->
                                                    <!--begin::Desc-->
                                                <p class="mb-4">{{$stock->dexcription}}</p>
                                                    <!--end::Desc-->
                                                    <!--begin::Info-->
                                                    <div class="mb-4">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="text-dark-75 font-weight-bolder mr-2">Stock No.:</span>
                                                        <a href="#" class="text-muted text-hover-primary">{{number_format($stock->id)}}</a>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-cente my-1">
                                                            <span class="text-dark-75 font-weight-bolder mr-2">Remaining Item:</span>
                                                            <a href="#" class="text-muted text-hover-primary">{{(number_format($stock->Qty-$stock->sales))}}</a>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="text-dark-75 font-weight-bolder mr-2">Price:</span>
                                                        <span class="text-muted font-weight-bold">{{number_format($stock->retail_price, 2)}}</span>
                                                        </div>
                                                    </div>
                                                    <input id={{$stock->id}} type="hidden" value={{json_encode($stock->item)}}>
                                                    <!--end::Info-->
                                                    <a href="#" class="btn btn-block btn-sm btn-light-success font-weight-bolder text-uppercase py-3" onclick="addToCart({{$stock->id}})"><i class="la la-plus"></i>add to cart</a>
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::Card-->
                                        </div>
                                        <!--end::Col-->
                                        
                                        @if($counter == 3 or $loop->last) 
                                            </div>
                                            @php 
                                                $counter = 0;
                                            @endphp
                                        @endif 
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-10">
                {{Form::submit('Save', ['class'=>'btn btn-success mr-2', 'id'=>'save'])}}
                {{Form::reset('Cancel', ['class' => 'btn btn-secondary', 'onclick'=>"javascript:location.href='/stockHeaders';"])}}
            </div>
        </div>
    </div>
    {{Form::close()}}
    <!--end::Entry-->
</div>
@endsection

@section('scripts')
<script src="/js/parsley.js"></script>
<script src="/js/pages/masterfiles/transactions/sales/customer_kttypeahead.js"></script>
<script src="/plugins/custom/datatables/datatables.bundle.js?v=7.0.4"></script>
    <script>
       $(document).ready(
           function(){
                $('#validate_form').parsley();
                $('.select2').select2({
                placeholder: "Pick an item",
                allowClear: true
                });

                document.getElementById("customer_name").addEventListener("blur", displayText);
                $('#kt_datatable').DataTable({searching: false, paging: false, info: false});
           }
       );
           function displayText(){
                var customer = $('#customer_name').val();
                var arrCustomer = customer.split(':');
               if(arrCustomer.length == 2){
                $('#customer_id').val(arrCustomer[0]);
                $('#customer_name').val(arrCustomer[1]);
               }
           }

           function addToCart(id){
                var data = document.getElementById(id).value;
                //var res = JSON.parse(data);
                console.log(data);
           }

    </script>
@endsection