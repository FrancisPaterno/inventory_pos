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

    {{Form::model($brand, ['action' => ['ItemBrandController@store', $brand->id],'id'=>'validate_form'])}}
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
                {{Form::text('name', null, ['class' => 'form-control' . ($errors->has('name')? ' is-invalid':null), 'required', 'data-parsley-length'=> '[5,100]', 'data-parsley-trigger'=>'keyup'])}}
                @error('name')
                <p class="invalid-feedback">{{$errors->first('name')}}</p>
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
        
        <div class="card-footer">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-10">
                    {{Form::submit('Save', ['class'=>'btn btn-success mr-2'])}}
                    {{Form::reset('Cancel', ['class' => 'btn btn-secondary', 'onclick'=>"javascript:location.href='/itembrand/index';"])}}
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
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