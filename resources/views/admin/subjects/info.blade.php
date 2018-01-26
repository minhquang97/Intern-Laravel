@extends('admin.layouts.master')
@section('content')
    <div class="col-md-9 ">
        <div class="row">
            <header style="color: #00bcd4;">Subject Information</header>
            <div class="panel-body" style="font-size: 12px;">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Credits</th>
                            <th>Number Class</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{!!$subject->id!!}</td>
                            <td>{!!$subject->name!!}</td>
                            <td>{!!$subject->credits!!}</td>
                            <td>{!! $subject->classes->count() !!} class</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <header style="color: #00bcd4;">Thong tin giang day</header>
            <div class="panel-body" style="font-size: 12px;">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Class ID</th>
                            <th>Teacher Name</th>
                            <th>Teacher ID</th>
                            <th>Semester</th>
                            <th>Number Student</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classes as $class)
                            <tr>
                                <th>{!! $class->id !!}   </th>
                                @if($class->teacher->id != 1)
                                <th>{!! $class->teacher->name !!}</th>
                                <th>{!! $class->teacher->id !!}</th>
                                @else
                                    <th>Chua co</th>
                                    <th>Chua co</th>
                                @endif
                                <th>{!! $class->semester !!}</th>
                                <th>{!! $class->students->count() !!}</th>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection