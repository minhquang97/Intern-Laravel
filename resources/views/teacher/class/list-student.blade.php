@extends('teacher.layouts.master')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>Danh sách học sinh</h2>
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
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Score</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $row)
                                    <tr>

                                        <td>{!!$row->id!!}</td>
                                        <td>
                                            {!!$row->name!!}

                                        </td>
                                        <td>{!!$row->email!!}</td>
{{--
                                        {{dd($row->classes)}}
--}}
                                        <td>@foreach($row->classes as $css)

                                            @if($css->pivot->class_id == $classes_id)
                                                    @if($css->pivot->score == -1)
                                                        ----
                                                    @else
                                                        {{$css->pivot->score}}
                                                        @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{!!route('teacher.class.update-score', ['id' => $row->id, 'classes_id' => $classes_id])!!}" title="Xem" class="btn btn-success" ><span >Update Score</span> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- {!! $data->render() !!}--}}
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
@endsection