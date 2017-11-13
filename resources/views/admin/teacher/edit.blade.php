@extends('admin.layouts.master')

@section('content')
    <div class="col-sm-7 col-sm-offset-3 col-lg-8 col-lg-offset-2 main">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><small>Sửa thông tin giáo viên </small></h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body" style="background-color: #ecf0f1; color:#27ae60;">
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
                        <form action="{{url('admin/edit-teacher')}}" method="POST" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        ID : <input type="text" name="id" id="txtID" class="form-control" value="{!! old('id',isset($data["id"]) ? $data["id"] : null) !!}" required="required">
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        Name : <input type="text" name="name" id="name" class="form-control" value="{!! old('name',isset($data->name) ? $data->name : null) !!}" required="required">
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        Birthday : <input type="text" name="birthday" id="txtbirthday" class="form-control" value="{!! old('birthday',isset($data->birthday) ? $data->birthday : null) !!}" class="form-control">
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        Email : <input type="text" name="email" id="txtemail" class="form-control" value="{!! old('email',isset($data->email) ? $data->email : null) !!}" class="form-control">
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        Password : <input type="text" name="password" id="txtpassword" class="form-control" value="{!! old('password',isset($data->password) ? $data->password : null) !!}" class="form-control">
                                    </div>

                                </div>
                            </div>

                            <input type="submit" name="btnCateAdd" class="btn btn-primary" value="Gửi chỉnh sửa" class="button" />
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
@endsection