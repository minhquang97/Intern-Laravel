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
                <a class="btn btn-success" href="{{ url('admin/subject/add-subject') }}"> Create New Subject</a>
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
                                    <th>Credits</th>

                                </tr>
                                </thead>
                                <tbody>
                                {{$i=0}}
                                @foreach($data as $row)
                                    <tr>

                                        <td>{!!$row->id!!}</td>
                                        <td>{!!$row->name!!}</td>
                                        <td>{!!$row->credits!!}</td>

                                        <td class="pull-right">
                                            <a href="{!!url('admin/subject/edit-subject/'.$row->id)!!}" title="Sửa" class="btn btn-info"><span >Edit</span> </a>
                                            <a href="{!!url('admin/subject/delete-subject/'.$row->id)!!}" class="btn btn-danger"><span>Remove</span> </a>
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