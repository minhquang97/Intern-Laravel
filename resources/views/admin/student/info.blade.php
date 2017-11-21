@extends('admin.layouts.master')
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif (Session()->has('flash_level'))
        <div class="alert alert-success">
            <ul>
                {!! Session::get('flash_massage') !!}
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
    <div class="col-md-9 ">
        <div class="row">
            <div class="col-md-6 col-md-offset-6">
                <div class="row">
                    <div class="col-md-9">
                        <form class="form-inline" method="POST" action="{{route('admin.student.find-avg', ['id' => $student->id])}}">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="semester"></label>
                                <input type="text" class="form-control" id="semester" placeholder="Enter Semester" name="semester">
                                <button type="submit" class="btn btn-success">Find Avg Score</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                         <a href="{{route('admin.student.info-student', ['id' => $student->id])}}" class="btn btn-success"> BACK</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <header style="color: #00bcd4;">Thong tin hoc sinh</header>
            <div class="panel-body" style="font-size: 12px;">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Birthday</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Class</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{!!$student->id!!}</td>
                                <td>{!!$student->name!!}</td>
                                <td>{!!$student->birthday!!}</td>
                                <td>{!!$student->email!!}</td>
                                <td>{!!$student->address!!}</td>
                                <td>{!!$student->class!!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <header style="color: #00bcd4;">Thong tin hoc tap</header>
            <div class="panel-body" style="font-size: 12px;">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Class ID</th>
                            {{--<th>Subject Name</th>--}}
                            <th>Subject ID</th>
                            <th>Semester</th>
                            <th>Score</th>
                        </tr>
                        </thead>
                        <tbody>
                                @foreach($classStudents as $class)
                                    <tr>
                                        <td>{!! $class->id !!}</td>
                                        <td>{!! $class->subject_id !!}</td>
                                        <td>{!! $class->semester !!}</td>
                                                @if($class->score != -1)
                                        <td>{!! $class->score !!}</td>
                                                @else
                                                    <td> chưa có điểm</td>
                                                @endif
                                    </tr>
                                @endforeach
                                @if(!!isset($avg))
                                <tr style="border-top: solid #000000">
                                    <td>AVG</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$avg}}</td>
                                </tr>
                                    @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection