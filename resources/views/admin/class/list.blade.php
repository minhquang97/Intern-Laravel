@extends('admin.layouts.master')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="col-sm-10 col-sm-offset-1 col-lg-10 col-lg-offset-0 main">
        <div class="row">
            <div class="col-sm-offset-6 col-sm-2 col-lg-offset-6 col-lg-2" >
                <a class="btn btn-success" href="{{ route('admin.class.get-add-class') }}"> Create New Class</a>
            </div>
            <div class="col-sm-offset-0 col-sm-3 col-lg-offset-0 col-lg-4">
                <form class="form-inline" method="POST" action="{{route('admin.class.search-class')}}">
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
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($classes as $class)
                                    <tr>

                                        <td>{!!$class->id!!}</td>
                                        <td>
                                            {!!App\Model\Subject::find($class->subject_id)->name!!}

                                        </td>
                                        <td>
                                            @if($class->teacher_id != 1)
                                                {!!App\Model\Teacher::find($class->teacher_id)->name!!}
                                            @else
                                                Chưa có
                                            @endif
                                        </td>
                                        <td>{!!$class->semester!!}</td>
                                        <td>
                                            <a href="{!!route('admin.class.get-edit-class', ['id' => $class->id])!!}" title="Sửa" class="btn btn-info"><span >Edit</span> </a>
                                            <a href="{!!route('admin.class.info-class', ['id' => $class->id])!!}" class="btn btn-success"><span>Info</span> </a>
                                        </td>
                                        <td>
                                            <form class="form-inline" method="POST" action="{!! route('admin.class.delete-class', ['id' => $class->id]) !!}">
                                                <input type="hidden" name="class_id" value="{{ $class->id }}">
                                                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                                {{ method_field('DELETE') }}
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$classes->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
@endsection