@extends('admin.layouts.master')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="col-sm-9 col-sm-offset-1 col-lg-9 col-lg-offset-0 main">
        <div class="row">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('admin/student/add-student') }}"> Create New Student</a>
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
                                    <th>Name</th>
                                    <th>Birthday</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Class</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $row)
                                    <tr>

                                        <td>{!!$row->id!!}</td>
                                        <td>{!!$row->name!!}</td>
                                        <td>{!!$row->birthday!!}</td>
                                        <td>{!!$row->email!!}</td>
                                        <td>{!!$row->address!!}</td>
                                        <td>{!!$row->class!!}</td>
                                        <td>
                                            <a href="{!!route('admin.student.get-edit-student', ['id' => $row->id])!!}" title="Sửa" class="btn btn-info"><span >Edit</span> </a>
                                            <a href="{!!route('admin.student.info-student', ['id' => $row->id])!!}" class="btn btn-success"><span>Info</span> </a>
                                        </td>
                                        <td>
                                            <form class="form-inline" method="POST" action="{!! route('admin.student.delete-student', ['id' => $row->id]) !!}">
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
                        {!! $data->render() !!}
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
@endsection