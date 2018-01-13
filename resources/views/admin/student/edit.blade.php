@extends('admin.layouts.master')

@section('content')
    <div class="col-sm-7 col-sm-offset-3 col-lg-8 col-lg-offset-2 main">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><small>Sửa thông tin học sinh </small></h1>
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
                        <form action="{{route('admin.student.post-edit-student',['id' => $student->id])}}" method="POST" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                        ID<span class="star-required">*</span> : <input type="text" name="id" id="txtID" class="form-control" value="{!! old('id',isset($student["id"]) ? $student["id"] : null) !!}" required="required">
                                    </div>
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                        Name<span class="star-required">*</span> : <input type="text" name="name" id="name" class="form-control" value="{!! old('name',isset($student->name) ? $student->name : null) !!}" required="required">
                                    </div>
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                        Birthday : <input type="text" name="birthday" id="txtbirthday" class="form-control" value="{!! old('birthday',isset($student->birthday) ? $student->birthday : null) !!}" >
                                    </div>
                                    <div class="col-xs-12 col-sm-5 col-md-6 col-lg-5">
                                        Email<span class="star-required">*</span> : <input type="text" name="email" id="txtemail" class="form-control" value="{!! old('email',isset($student->email) ? $student->email : null) !!}" >
                                    </div>
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                        Address : <input type="text" name="address" id="txtaddress" class="form-control" value="{!! old('address',isset($student->address) ? $student->address : null) !!}">
                                    </div>
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                        Class : <input type="text" name="class" id="txtclass" class="form-control" value="{!! old('class',isset($student->class) ? $student->class : null) !!}" >
                                    </div>
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                        Password<span class="star-required">*</span> : <input type="text" name="password" id="txtpassword"  class="form-control">
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