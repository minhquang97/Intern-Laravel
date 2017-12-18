@extends('teacher.layouts.master')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
    <div class="col-sm-10 col-sm-offset-1 col-lg-10 col-lg-offset-0 main">
        <div class="row">
            <div class="col-sm-offset-7 col-sm-3 col-lg-offset-7 col-lg-4">
                <form class="form-inline" method="POST" action="{{route('teacher.class.search-class')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nameOrId"></label>
                        <input type="text" class="form-control" id="nameOrId" placeholder="Class Name or ID" name="nameOrId" required="required">
                        <button type="submit" class="btn btn-success">Search Class</button>
                    </div>
                </form>
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
                                    <th>Credits</th>
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
                                                {!!$row->teacher->name!!}
                                            @else
                                                Chưa có
                                            @endif
                                        </td>
                                        <td>{!!$row->semester!!}</td>
                                        <td>{!!$row->subject->credits!!}</td>
                                        <td>
                                            <a href="{!!route('teacher.class.register-class', ['id' => $row->id])!!}" title="Sửa" class="btn btn-info"><span >Register</span> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$data->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
@endsection