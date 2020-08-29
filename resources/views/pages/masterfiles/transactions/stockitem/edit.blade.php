@extends('pages.masterfiles.transactions.stock.show')

@section('styles_item')
<link href="/css/pages/forms/parsley.css?v=7.0.4" rel="stylesheet" type="text/css" />
@endsection

@section('content_item')
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            {{$form_title}}
        </h3>
    </div>
    <!--begin::Form-->
    {{Form::model($stockItem, ['action' => ['StockItemController@update', $stockItem->id], 'id' => 'validate_form_item', 'data-parsley-validate' , 'method' => 'put'])}}
    {{Form::hidden('stock_header_id', $stockHeader->id)}}
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
                    {{Form::label('item_id', 'Item*', ['class'=> 'col-2 col-form-label'])}}
                    <div class="col-10">
                        {{Form::select('item_id', $items, null, ['placeholder'=>'', 'class' => 'form-control select2' . ($errors->has('item_id')? ' is-invalid':null), 'required', 'data-parsley-trigger'=> 'keyup'])}} 
                        @error('item_id')
                        <p class="invalid-feedback">{{$errors->first('item_id')}}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('description', 'Description', ['class'=> 'col-2 col-form-label'])}}
                    <div class="col-10">
                        {{Form::textarea('description', null, ['class' => 'form-control' . ($errors->has('description')? ' is-invalid':null), 'data-parsley-length'=> '[0, 500]', 'data-parsley-trigger'=> 'keyup'])}}
                        @error('description')
                        <p class="invalid-feedback">{{$errors->first('description')}}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('Qty', 'Quantity*', ['class'=> 'col-2 col-form-label'])}}
                    <div class="col-10">
                        {{Form::number('Qty', null, ['class' => 'form-control' . ($errors->has('Qty')? ' is-invalid':null), 'required', 'data-parsley-trigger'=> 'keyup'])}} 
                        @error('Qty')
                        <p class="invalid-feedback">{{$errors->first('Qty')}}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('wholesale_price', 'Wholesale price*', ['class'=> 'col-2 col-form-label'])}}
                    <div class="col-10">
                        {{Form::number('wholesale_price', null, ['placeholder'=>'', 'class' => 'form-control' . ($errors->has('wholesale_price')? ' is-invalid':null), 'required', 'data-parsley-trigger'=> 'keyup'])}} 
                        @error('wholesale_price')
                        <p class="invalid-feedback">{{$errors->first('wholesale_price')}}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('retail_price', 'Retail price*', ['class'=> 'col-2 col-form-label'])}}
                    <div class="col-10">
                        {{Form::number('retail_price', null, ['class' => 'form-control' . ($errors->has('retail_price')? ' is-invalid':null), 'required', 'data-parsley-trigger'=>'keyup'])}}
                        @error('retail_price')
                            <p class="invalid-feedback">{{$errors->first('retail_price')}}</p>
                        @enderror
                    </div>
                </div>
            
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2">
                        </div>
                        <div class="col-10">
                            {{Form::submit('Save', ['class'=>'btn btn-success mr-2'])}}
                            {{Form::button('Cancel', ['class' => 'btn btn-secondary', 'onclick'=>"javascript:location.href='/stockHeaders/" . $stockHeader->id ."';"])}}
                        </div>
                    </div>
                </div>
            </div> 
    {{Form::close()}}
</div>
@endsection

@section('scripts_item')
<script src="/js/parsley.js"></script>
<script>
    $(document).ready(
        function(){
            $('#validate_from_item').parsley();
            $('.select2').select2({
            placeholder: "Pick an item",
            allowClear: true
            });
        }    
    );
</script>
@endsection