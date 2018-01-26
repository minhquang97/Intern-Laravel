@extends('admin.layouts.master')

@section('content')
    <div class="col-sm-7 col-sm-offset-2 col-lg-8 col-lg-offset-1 main" >
    <h2>Create New Teacher</h2>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Teacher</strong><br/>There were some problems with your input.<br/><br/>
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
                @if ($errors->has('name'))
                    {{$errors->first('name')}}
                @endif
            </ul>
            Mời nhập lại
        </div>

    @endif

    {!! Form::open(array ('route' => 'admin.teacher.post-add-teacher' , 'method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3">
                <div class="form-group">
                    <strong>ID<span class="star-required">*</span></strong>
                    {!! Form::text('id', null, array('placeholder' => 'Teacher ID: 123','class' => 'form-control','required' => 'required')) !!}
                </div>
                <div class="form-group">
                    <strong>Name<span class="star-required">*</span></strong>
                    {!! Form::text('name', null, array('placeholder' => 'Teacher Name: Minh Quang dep trai','class' => 'form-control','required' => 'required')) !!}
                </div>
                <div class="form-group">
                    <strong>Email<span class="star-required">*</span></strong>
                    {!! Form::text('email', null, array('placeholder' => 'Teacher Email: minhquang4334@gmail.com','class' => 'form-control','required' => 'required')) !!}

                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3">
                <div class="form-group">
                    <strong>Date of birth</strong>
                    {!! Form::text('birthday', null, array('placeholder' => 'Birthday: 1997-03-04','class' => 'form-control', 'value' => "{{old('birthday')}},'required' => 'required'")) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3">
                <div class="form-group">
                    <strong>Password<span class="star-required">*</span></strong>
                    {!! Form::text('password', null, array('placeholder' => 'Password: 123456', 'class' => 'form-control', 'required' => 'required')) !!}
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    {!! Form::close() !!}
    </div>
@endsection