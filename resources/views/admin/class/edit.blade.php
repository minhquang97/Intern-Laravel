@extends('admin.layouts.master')

@section('content')
    <div class="col-sm-7 col-sm-offset-3 col-lg-8 col-lg-offset-2 main">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><small>Sửa thông tin lớp </small></h1>
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
                        <form action="{{route('admin.class.post-edit-class', ['id' => $data->id])}}" method="POST" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        Kì học : <input type="text" name="semester" id="semester" class="form-control" value="{!! old('semester',isset($data->semester) ? $data->semester : null) !!}" required="required">
                                    </div>


                                </div>
                            </div>

                            <input type="submit" name="btnCateAdd" class="btn btn-primary" value="Update" class="button" />
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
@endsection