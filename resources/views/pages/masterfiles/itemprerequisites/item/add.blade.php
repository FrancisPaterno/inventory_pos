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
    {{Form::model($item, ['action' => ['ItemController@store', $item->id], 'id' => 'validate_form'])}}
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
                {{Form::label('barcode', 'Barcode*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::text('barcode', null, ['class' => 'form-control' . ($errors->has('barcode')? ' is-invalid':null), 'required', 'data-parsley-minlength'=> '[13]', 'data-parsley-maxlength'=>'[13]', 'data-parsley-trigger'=>'keyup'])}}
                    @error('barcode')
                        <p class="invalid-feedback">{{$errors->first('barcode')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('name', 'Name*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::text('name', null, ['class' => 'form-control' . ($errors->has('name')? ' is-invalid':null), 'required', 'data-parsley-length'=> '[3,150]', 'data-parsley-trigger'=>'keyup'])}}
                    @error('name')
                        <p class="invalid-feedback">{{$errors->first('name')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('sku', 'SKU', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::text('sku', null, ['class' => 'form-control' . ($errors->has('sku')? ' is-invalid':null), 'data-parsley-length'=> '[0,100]', 'data-parsley-trigger'=>'keyup'])}}
                    @error('sku')
                        <p class="invalid-feedback">{{$errors->first('sku')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('description', 'Description', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::textarea('description', null, ['class' => 'form-control' . ($errors->has('description')? ' is-invalid':null), 'data-parsley-length'=> '[0, 500]', 'data-parsley-trigger'=> 'keyup'])}}
                    @error('name')
                    <p class="invalid-feedback">{{$errors->first('description')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('item_category_id', 'Category*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                   {{Form::select('item_category_id', $categories, null, ['placeholder'=>'', 'class' => 'form-control select2' . ($errors->has('item_category_id')?' is-invalid':null), 'required'])}}
                   @error('item_category_id')
                   <p class="invalid-feedback">{{$errors->first('item_category_id')}}</p>
                   @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('item_brand_id', 'Brand*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                   {{Form::select('item_brand_id', $brands, null, ['placeholder'=>'', 'class' => 'form-control select2' . ($errors->has('item_brand_id')?' is-invalid':null), 'required'])}}
                   @error('item_brand_id')
                   <p class="invalid-feedback">{{$errors->first('item_brand_id')}}</p>
                   @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('item_unit_id', 'Unit*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                   {{Form::select('item_unit_id', $units, null, ['placeholder'=>'', 'class' => 'form-control select2' . ($errors->has('item_unit_id')?' is-invalid':null), 'required'])}}
                   @error('item_unit_id')
                   <p class="invalid-feedback">{{$errors->first('item_unit_id')}}</p>
                   @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('item_status_id', 'Status*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                   {{Form::select('item_status_id', $statuses, null, ['placeholder'=>'', 'class' => 'form-control select2' . ($errors->has('item_status_id')?' is-invalid':null), 'required'])}}
                   @error('item_status_id')
                   <p class="invalid-feedback">{{$errors->first('item_status_id')}}</p>
                   @enderror
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        {{Form::submit('Save', ['class'=>'btn btn-success mr-2'])}}
                        {{Form::reset('Cancel', ['class' => 'btn btn-secondary', 'onclick'=>"javascript:location.href='/item/index';"])}}
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