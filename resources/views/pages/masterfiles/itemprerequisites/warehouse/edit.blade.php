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
    {{Form::model($warehouse, ['action' => ['WarehouseController@update', $warehouse->id], 'id' => 'validate_form', 'method'=>'put'])}}
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
                {{Form::label('name', 'Name*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::text('name', null, ['class' => 'form-control' . ($errors->has('name')? ' is-invalid':null), 'required', 'data-parsley-length'=> '[3,50]', 'data-parsley-trigger'=>'keyup'])}}
                    @error('name')
                        <p class="invalid-feedback">{{$errors->first('name')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('address', 'Address*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::textarea('address', null, ['class' => 'form-control' . ($errors->has('address')? ' is-invalid':null), 'required', 'data-parsley-length'=> '[5, 400]', 'data-parsley-trigger'=> 'keyup'])}}
                    @error('address')
                    <p class="invalid-feedback">{{$errors->first('address')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('contact', 'Contact*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::text('contact', null, ['class' => 'form-control' . ($errors->has('contact')? ' is-invalid':null), 'required', 'data-parsley-length'=> '[5, 30]', 'data-parsley-trigger'=> 'keyup'])}}
                    @error('contact')
                    <p class="invalid-feedback">{{$errors->first('contact')}}</p>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        {{Form::submit('Save', ['class'=>'btn btn-success mr-2'])}}
                        {{Form::reset('Cancel', ['class' => 'btn btn-secondary', 'onclick'=>"javascript:location.href='/warehouse/index';"])}}
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
           }
       );
    </script>
@endsection