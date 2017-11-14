@extends('admin.layouts.master')

@section('content')
    <div class="col-sm-7 col-sm-offset-2 col-lg-8 col-lg-offset-1 main" >
    <h2>Create New Subject</h2>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Subject</strong><br/>There were some problems with your input.<br/><br/>
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

    {!! Form::open(array ('url' => 'admin/subject/add-subject' , 'method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3">
                <div class="form-group">
                    <strong>ID</strong>
                    {!! Form::text('id', null, array('placeholder' => 'Subject ID','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Name</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Subject Name','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Credits</strong>
                    {!! Form::text('credits', null, array('placeholder' => 'Subject Credits','class' => 'form-control')) !!}

                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    {!! Form::close() !!}
    </div>
@endsection