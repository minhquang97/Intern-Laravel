@extends('layouts.app')

@section('content')
    <div class="row">
            <div class="col-lg-3 col-md-3">
                <h2>Student CRUD</h2>
            </div>
            <div class="col-lg-5 col-lg-offset-4 col-md-5 col-md-offset-4"  style="margin-top: 20px;">
              
                 {!! Form::open(array ('url' => 'student/search' , 'method'=>'POST','class'=>'form-inline')) !!}
                              <a class="btn btn-success" href="{{ route('student.create') }}"> Create New Student</a>
                            <div class="form-group">
                            {!! Form::text('name', null, array('placeholder' => 'Search','class' => 'form-control' )) !!}
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                {!! Form::close() !!}
            </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="alert alert-danger">
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