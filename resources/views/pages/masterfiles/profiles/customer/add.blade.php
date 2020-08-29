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
    {{Form::model($customer, ['action' => ['CustomerController@store', $customer->id], 'id' => 'validate_form'])}}
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
                {{Form::label('firstname', 'Firstname*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::text('firstname', null, ['class' => 'form-control' . ($errors->has('firstname')? ' is-invalid':null), 'required', 'data-parsley-length'=> '[3,100]', 'data-parsley-trigger'=>'keyup'])}}
                    @error('firstname')
                        <p class="invalid-feedback">{{$errors->first('firstname')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('middlename', 'Middlename', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::text('middlename', null, ['class' => 'form-control' . ($errors->has('middlename')? ' is-invalid':null), 'data-parsley-length'=> '[0, 100]', 'data-parsley-trigger'=> 'keyup'])}}
                    @error('middlename')
                    <p class="invalid-feedback">{{$errors->first('middlename')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('lastname', 'Lastname*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::text('lastname', null, ['class' => 'form-control' . ($errors->has('lastname')? ' is-invalid':null), 'required', 'data-parsley-length'=> '[3,100]', 'data-parsley-trigger'=>'keyup'])}}
                    @error('lastname')
                        <p class="invalid-feedback">{{$errors->first('lastname')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('gender_id', 'Gender*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::select('gender_id', $genders, null, ['placeholder'=>'Pick an item...', 'class' => 'form-control' . ($errors->has('gender_id')?' is-invalid':null), 'required'])}}
                    @error('gender_id')
                    <p class="invalid-feedback">{{$errors->first('gender_id')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('address', 'Address', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::textarea('address', null, ['class' => 'form-control' . ($errors->has('address')? ' is-invalid':null), 'data-parsley-length'=> '[0, 400]', 'data-parsley-trigger'=> 'keyup'])}}
                    @error('address')
                    <p class="invalid-feedback">{{$errors->first('address')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('email', 'Email', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::text('email', null, ['class' => 'form-control' . ($errors->has('email')? ' is-invalid':null), 'data-parsley-length'=> '[5, 150]', 'data-parsley-trigger'=> 'keyup', 'data-parsley-type'=>'email'])}}
                    @error('email')
                    <p class="invalid-feedback">{{$errors->first('email')}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{Form::label('contact', 'Contact*', ['class'=> 'col-2 col-form-label'])}}
                <div class="col-10">
                    {{Form::text('contact', null, ['class' => 'form-control' . ($errors->has('contact')? ' is-invalid':null),'required', 'data-parsley-length'=> '[7, 30]', 'data-parsley-trigger'=> 'keyup'])}}
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
                        {{Form::reset('Cancel', ['class' => 'btn btn-secondary', 'onclick'=>"javascript:location.href='/customer/index';"])}}
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