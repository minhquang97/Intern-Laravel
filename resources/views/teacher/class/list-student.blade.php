@extends('teacher.layouts.master')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>Danh sách học sinh</h2>
    <div class="col-sm-10 col-sm-offset-1 col-lg-10 col-lg-offset-0 main">
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
                                    <th>Class</th>
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
--}}                                    <td>{{$row->class}}</td>
                                        @if($row->pivot->score != -1)
                                        <td>{!! $row->pivot->score !!}</td>
                                        @else
                                            <td>------</td>
                                        @endif
                                        <td>
                                            <form class="form-inline" method="POST" action="{{route('teacher.class.update-score', ['id' => $row->id, 'classes_id' => $classes_id])}}">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label for="semester"></label>
                                                    <input type="text" class="form-control" id="semester" placeholder="Enter Score" name="score">
                                                    <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to change this item?');">Update Score</button>
                                                </div>
                                            </form>
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