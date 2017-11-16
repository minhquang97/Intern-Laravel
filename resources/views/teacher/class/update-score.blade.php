@extends('teacher.layouts.master')
@section('content')
    <form action="{{url('teacher/class/update-score/'.$student->id.'/'.$classes_id)}}" method="POST">
        {!! csrf_field() !!}
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 ">
            <div class="form-group">
                <strong>Input Score for {{$student->name}}</strong>
                {!! Form::text('score', null, array('placeholder' => 'Score','class' => 'form-control')) !!}

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    </form>



@endsection