@extends('admin.layouts.master')

@section('content')
    <div class="col-sm-7 col-sm-offset-2 col-lg-8 col-lg-offset-1 main" >
    <h2>Create New Class</h2>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Class</strong><br/>There were some problems with your input.<br/><br/>
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

    {!! Form::open(array ('route' => 'admin.class.post-add-class' , 'method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3">
                <div class="form-group">
                    <label for="input-id">Chọn môn học</label>
                    <select name="subject_id" id="subject_id" required class="form-control">
                        <option value="">--Môn học--</option>
                        @foreach($subject as $sub)
                            <option value="{!!$sub->id!!}" >{!!'--|--|'.$sub->name!!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3">
                <div class="form-group">
                    <strong>ID</strong>
                    {!! Form::text('id', null, array('placeholder' => 'Class ID','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Semester</strong>
                    {!! Form::text('semester', null, array('placeholder' => 'Class Name','class' => 'form-control')) !!}
                </div>

            </div>

            <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    {!! Form::close() !!}
    </div>
@endsection