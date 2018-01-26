@extends('teacher.layouts.master')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="col-md-4 col-md-offset-2">
            <h3>Thông tin giáo viên</h3>

                <p>{!!Auth::guard('teacher')->user()->name!!}</p>
                <p>{!!Auth::guard('teacher')->user()->birthday!!}</p>
                <p>{!!Auth::guard('teacher')->user()->email!!}</p>

        </div>
    </div>
@endsection
