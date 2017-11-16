@extends('student.layouts.master')
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
    <div class="col-sm-7 col-sm-offset-2 col-lg-8 col-lg-offset-1 main">
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
                                {{$i=0}}
                                @foreach($data as $row)
                                    <tr>

                                        <td>{!!$row->id!!}</td>
                                        <td>
                                            {!!App\Model\Subject::find($row->subject_id)->name!!}

                                        </td>
                                        <td>
                                            @if($row->teacher_id != 1)
                                                {!!App\Model\Teacher::find($row->teacher_id)->name!!}
                                            @else
                                                Chưa có
                                            @endif
                                        </td>
                                        <td>{!!$row->semester!!}</td>
                                        <td>{!!App\Model\Subject::find($row->subject_id)->credits!!}</td>
                                        <td>
                                            <a href="{!!url('student/class/register-class/'.$row->id)!!}" title="Sửa" class="btn btn-info"><span >Register</span> </a>
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