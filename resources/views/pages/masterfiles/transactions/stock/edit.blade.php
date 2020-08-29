@extends('layout.default')

@section('styles')
<link href="/css/pages/forms/parsley.css?v=7.0.4" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            {{$form_title}}
        </h3>
    </div>
    <!--begin::Form-->
    {{Form::model($stock, ['action' => ['StockHeaderController@update', $stock->id], 'id' => 'validate_form', 'method'=>'put'])}}
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
                {{Form::label('delivery_receipt_no', 'Delivery Receipt No', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::text('delivery_receipt_no', null, ['class' => 'form-control' . ($errors->has('delivery_receipt_no')? ' is-invalid':null), 'data-parsley-length'=> '[0,30]', 'data-parsley-trigger'=>'keyup'])}}
                    @error('delivery_receipt_no')
                        <p class="invalid-feedback">{{$errors->first('delivery_receipt_no')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('description', 'Description*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::textarea('description', null, ['class' => 'form-control' . ($errors->has('description')? ' is-invalid':null), 'data-parsley-length'=> '[0, 400]', 'data-parsley-trigger'=> 'keyup'])}}
                    @error('description')
                    <p class="invalid-feedback">{{$errors->first('description')}}</p>
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
                {{Form::label('warehouse_id', 'Warehouse*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::select('warehouse_id', $warehouses, null, ['placeholder'=>'', 'class' => 'form-control select2' . ($errors->has('warehouse_id')? ' is-invalid':null), 'required', 'data-parsley-trigger'=> 'keyup'])}} 
                    @error('warehouse_id')
                    <p class="invalid-feedback">{{$errors->first('warehouse_id')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('supplier_id', 'Supplier*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::select('supplier_id', $suppliers, null, ['placeholder'=>'', 'class' => 'form-control select2' . ($errors->has('supplier_id')? ' is-invalid':null), 'required', 'data-parsley-trigger'=> 'keyup'])}} 
                    @error('supplier_id')
                    <p class="invalid-feedback">{{$errors->first('supplier_id')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('total', 'Total', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::number('total', null, ['class' => 'form-control' . ($errors->has('total')? ' is-invalid':null), 'required', 'data-parsley-trigger'=>'keyup'])}}
                    @error('total')
                        <p class="invalid-feedback">{{$errors->first('total')}}</p>
                    @enderror
                </div>
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
</div>
@endsection

@section('scripts')
<script src="/js/parsley.js"></script>
    <script>
       $(document).ready(
           function(){
                $('#validate_form').parsley();
                $('.select2').select2({
                placeholder: "Pick an item",
                allowClear: true
                });
           }
       );
    </script>
@endsection