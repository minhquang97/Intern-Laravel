@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Student</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('student.index') }}"> Back </a>
                   
            </div>
        </div>
    </div>

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

    {!! Form::open(array ('route' => 'student.store' , 'method'=>'POST')) !!}
         @include('student.form')
    {!! Form::close() !!}

@endsection