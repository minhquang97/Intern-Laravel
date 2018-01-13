@extends('teacher.layouts.master')

@section('content')
    <div class="col-sm-7 col-sm-offset-1 col-lg-8 col-lg-offset-1 main">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><small>Update thong tin </small></h1>
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
                        <form action="{{route('teacher.update-info')}}" method="POST" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                        Name : <input type="text" name="name" id="name" class="form-control" value="{!! old('name',isset($teacher->name) ? $teacher->name : null) !!}" required="required">
                                    </div>
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                        Birthday : <input type="text" name="birthday" id="txtbirthday" class="form-control" value="{!! old('birthday',isset($teacher->birthday) ? $teacher->birthday : null) !!}" >
                                    </div>
                                    <div class="col-xs-12 col-sm-5 col-md-6 col-lg-5">
                                        Email : <input type="text" name="email" id="txtemail" class="form-control" value="{!! old('email',isset($teacher->email) ? $teacher->email : null) !!}" >
                                    </div>
                                </div>
                            </div>

                            <input type="submit" name="btnCateAdd" class="btn btn-primary" value="Gửi chỉnh sửa" />
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
@endsection