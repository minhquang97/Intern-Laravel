@extends('student.layouts.master')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="col-md-4 col-md-offset-2">
            <h3>Thông tin học sinh</h3>
                <p>{!!Auth::guard('student')->user()->id!!}</p>
                <p>{!!Auth::guard('student')->user()->name!!}</p>
                <p>{!!Auth::guard('student')->user()->birthday!!}</p>
                <p>{!!Auth::guard('student')->user()->email!!}</p>
                <p>{!!Auth::guard('student')->user()->class!!}</p>
                <p>{!!Auth::guard('student')->user()->address!!}</p>
        </div>
    </div>
@endsection
