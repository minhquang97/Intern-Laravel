@extends('admin.layouts.master')
@section('content')
    <div class="col-md-9 ">
        <div class="row">
            <header style="color: #00bcd4;">Teacher Information</header>
            <div class="panel-body" style="font-size: 12px;">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Birthday</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{!!$teacher->id!!}</td>
                            <td>{!!$teacher->name!!}</td>
                            <td>{!!$teacher->birthday!!}</td>
                            <td>{!!$teacher->email!!}</td>
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
                            {{--<th>Subject Name</th>--}}
                            <th>Subject ID</th>
                            <th>Semester</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classes as $class)
                            <tr>
                                <th>{!! $class->id !!}   </th>
                                <th>{!! $class->subject_id !!}</th>
                                <th>{!! $class->semester !!}</th>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection