@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Student CRUD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('student.create') }}"> Create New Student</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Birthday</th>
            <th>Address</th>
            <th>Class</th>

            <th width="280px">Action</th>
        </tr>
    @foreach ($students as $student)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $student->name}}</td>
        <td>{{ $student->birthday}}</td>
        <td>{{ $student->address}}</td>
        <td>{{ $student->class}}</td>
        <td>
            <a class="btn btn-info" href="{{ route('student.show',$student->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('student.edit',$student->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['student.destroy', $student->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>


    {!! $students->links() !!}
@endsection