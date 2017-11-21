@extends('admin.layouts.master')

@section('content')
    <div class="col-sm-7 col-sm-offset-2 col-lg-8 col-lg-offset-1 main" >
    <h2>Create New Student</h2>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Student</strong><br/>There were some problems with your input.<br/><br/>
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

    {!! Form::open(array ('route' => 'admin.student.post-add-student' , 'method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 ">
                <div class="form-group">
                    <strong>ID</strong>
                    {!! Form::text('id', null, array('placeholder' => 'Student ID','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Name</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Student Name','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Email</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Student Email','class' => 'form-control')) !!}

                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 ">
                <div class="form-group">
                    <strong>Date of birth</strong>
                    {!! Form::text('birthday', null, array('placeholder' => 'Date of Birth','class' => 'form-control', 'value' => "{{old('birthday')}}")) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 ">
                <div class="form-group">
                    <strong>Address</strong>
                    {!! Form::text('address', null, array('placeholder' => 'Address','class' => 'form-control', 'value' => "{{old('address')}}")) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6  ">
                <div class="form-group">
                    <strong>Class</strong>
                    {!! Form::text('class', null, array('placeholder' => 'Class','class' => 'form-control', 'value' => "{{old('class')}}")) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6  ">
                <div class="form-group">
                    <strong>Password</strong>
                    {!! Form::text('password', null, array('placeholder' => 'Password','class' => 'form-control', 'type' => 'password')) !!}
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {!! Form::close() !!}
    </div>
@endsection