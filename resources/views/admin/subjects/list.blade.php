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
                <a class="btn btn-success" href="{{ route('admin.subject.get-add-subject') }}"> Create New Subject</a>
            </div>
            <div class="col-sm-offset-0 col-sm-3 col-lg-offset-0 col-lg-4">
                <form class="form-inline" method="POST" action="{{route('admin.subject.search-subject')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nameOrId"></label>
                        <input type="text" class="form-control" id="nameOrId" placeholder="Subject Name or ID" name="nameOrId">
                        <button type="submit" class="btn btn-success">Search Subject</button>
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
                                    <th>Name</th>
                                    <th>Credits</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($subjects as $subject)
                                    <tr>
                                        <td>{!!$subject->id!!}</td>
                                        <td>{!!$subject->name!!}</td>
                                        <td>{!!$subject->credits!!}</td>
                                        <td>{!! $subject->created_at !!}</td>
                                        <td>{!! $subject->updated_at !!}</td>
                                        <td >
                                            <a href="{!!route('admin.subject.get-edit-subject', ['id' => $subject->id])!!}" title="Sửa" class="btn btn-info"><span >Edit</span> </a>
                                            <a href="{!!route('admin.subject.info-subject', ['id' => $subject->id])!!}" class="btn btn-success"><span>Info</span> </a>
                                        </td>
                                        <td>
                                            <form class="form-inline" method="POST" action="{!! route('admin.subject.delete-subject', ['id' => $subject->id]) !!}">
                                                <input type="hidden" name="class_id" value="{{ $subject->id }}">
                                                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                                {{ method_field('DELETE') }}
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$subjects->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
@endsection