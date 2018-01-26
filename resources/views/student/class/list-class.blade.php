@extends('student.layouts.master')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>Danh sách các lớp đã đăng ký</h2>
    <div class="col-sm-10 col-sm-offset-1 col-lg-10 col-lg-offset-0 main">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

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
                    <div class="panel-body" style="font-size: 12px;">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Subject Name</th>
                                    <th>Teacher Name</th>
                                    <th>Semester</th>
                                    <th>Credits</th>
                                    <th>Score</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $row)
                                    <tr>

                                        <td>{!!$row->id!!}</td>
                                        <td>
                                            {!!$row->subject->name!!}

                                        </td>
                                        <td>
                                            @if($row->teacher_id != 1)
                                                {!! $row->teacher->name !!}
                                            @else
                                                Chưa có
                                            @endif
                                        </td>
                                        <td>{!!$row->semester!!}</td>
                                        <td>{!!$row->subject->credits!!}</td>
                                        @if($row->pivot->score!=-1)
                                        <td>{!! $row->pivot->score !!}</td>
                                        @else
                                            <td>Chua co</td>
                                        @endif
                                        <td>
                                            <form class="form-inline" method="POST" action="{!! route('student.class.delete-class', ['id' => $row->id]) !!}">
                                                <input type="hidden" name="class_id" value="{{ $row->id }}">
                                                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                                {{ method_field('DELETE') }}
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                       {{-- {!! $data->render() !!}--}}
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
@endsection