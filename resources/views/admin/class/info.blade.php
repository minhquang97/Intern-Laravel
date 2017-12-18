@extends('admin.layouts.master')
@section('content')
    <div class="col-md-9 ">
        <div class="row">
            <header style="color: #00bcd4;">Class Information</header>
            <div class="panel-body" style="font-size: 12px;">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Semester</th>
                            <th>Teacher Id</th>
                            <th>Teacher Name</th>
                            <th>Student Number</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{!!$class->id!!}</td>
                            <td>{!!$class->semester!!}</td>
                            @if($class->teacher->id != 1)
                            <td>{!!$class->teacher->id!!}</td>
                            <td>{!! $class->teacher->name !!} </td>
                            @else
                                <td style='color: red;'>Chưa có</td>
                                <td style='color: red;'>Chưa có</td>
                            @endif
                            <td>{!! $students->count() !!}</td>
                        </tr>
                        </tbody>
                    </table>
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
                            <th>STT</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Student Email</th>
                            <th>Score</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <th> {!! $i++ !!}</th>
                                <th>{!! $student->id !!}   </th>
                                <th>{!! $student->name !!}</th>
                                <th>{!! $student->email !!}</th>
                                @if($student->pivot->score != -1)
                                <th>{!! $student->pivot->score !!}</th>
                                    @else
                                <th style="color:red;"> Chưa có điểm</th>
                                    @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection