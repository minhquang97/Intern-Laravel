@extends('admin.layouts.master')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="col-sm-10 col-lg-10 col-md-10 col-lg-offset-0 main">
        <div class="row">
            <div class="col-sm-offset-5 col-sm-2 col-md-2 col-lg-offset-5 col-lg-2" >
                <a class="btn btn-success" href="{{ route('admin.teacher.add-teacher') }}"> Create New Teacher</a>
            </div>
            <div class="col-sm-5 col-lg-5">
                <form class="form-inline" method="POST" action="{{route('admin.teacher.search-teacher')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nameOrId"></label>
                        <input type="text" class="form-control" id="nameOrId" placeholder="Teacher Name or ID" name="nameOrId" required="required">
                        <button type="submit" class="btn btn-success">Search Teacher</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
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
                                @foreach($teachers as $teacher)
                                    @if($teacher->id !=1)
                                        <tr>

                                            <td>{!!$teacher->id!!}</td>
                                            <td>{!!$teacher->name!!}</td>
                                            <td>{!!$teacher->birthday!!}</td>
                                            <td>{!!$teacher->email!!}</td>
                                            <td>
                                                @if(!$teacher->status)
                                                    <span style="color: red;">Chưa kích hoạt</span>
                                                @else <span style="color: #2a88bd;"> Đã kích hoạt</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{!!route('admin.teacher.get-edit-teacher',['id' => $teacher->id])!!}" title="Sửa" class="btn btn-info"><span >Edit</span> </a>
                                                <a href="{!!route('admin.teacher.info-teacher', ['id' => $teacher->id])!!}" class="btn btn-success"><span>Info</span> </a>
                                            </td>
                                            <td>
                                                <form class="form-inline" method="POST" action="{!! route('admin.teacher.delete-teacher', ['id' => $teacher->id]) !!}">
                                                    <input type="hidden" name="class_id" value="{{ $teacher->id }}">
                                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                                    {{ method_field('DELETE') }}
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            {{$teachers->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
@endsection