@extends('admin.layouts.master')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="col-sm-7 col-sm-offset-2 col-lg-8 col-lg-offset-1 main">
        <div class="row">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('admin.class.get-add-class') }}"> Create New Class</a>
            </div>
        </div>
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
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $row)
                                    <tr>

                                        <td>{!!$row->id!!}</td>
                                        <td>
                                            {!!App\Model\Subject::find($row->subject_id)->name!!}

                                        </td>
                                        <td>
                                            @if($row->teacher_id != 1)
                                                {!!App\Model\Teacher::find($row->teacher_id)->name!!}
                                            @else
                                                Chưa có
                                            @endif
                                        </td>
                                        <td>{!!$row->semester!!}</td>
                                        <td>
                                            <a href="{!!route('admin.class.get-edit-class', ['id' => $row->id])!!}" title="Sửa" class="btn btn-info"><span >Edit</span> </a>
                                            <a href="{!!route('admin.student.info-student', ['id' => $row->id])!!}" class="btn btn-success"><span>Info</span> </a>
                                        </td>
                                        <td>
                                            <form class="form-inline" method="POST" action="{!! route('admin.class.delete-class', ['id' => $row->id]) !!}">
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
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
@endsection