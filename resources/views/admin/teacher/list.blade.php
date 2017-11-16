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
                <a class="btn btn-success" href="{{ url('admin/teacher/add-teacher') }}"> Create New Teacher</a>
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
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $row)
                                    @if($row->id !=1)
                                        <tr>

                                            <td>{!!$row->id!!}</td>
                                            <td>{!!$row->name!!}</td>
                                            <td>{!!$row->birthday!!}</td>
                                            <td>{!!$row->email!!}</td>
                                            <td>
                                            @if($row->status == 1)
                                                Đã kích hoạt
                                            @endif
                                                Chưa kích hoạt
                                            </td>
                                            <td>
                                                <a href="{!!url('admin/teacher/edit-teacher/'.$row->id)!!}" title="Sửa" class="btn btn-info"><span >Edit</span> </a>
                                                <a href="{!!url('admin/student/info-student/'.$row->id)!!}" class="btn btn-success"><span>Info</span> </a>
                                                <a href="{!!url('admin/teacher/delete-teacher/'.$row->id)!!}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><span>Remove</span> </a>
                                            </td>
                                        </tr>
                                    @endif
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