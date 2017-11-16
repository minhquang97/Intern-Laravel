@extends('teacher.layouts.master')
@section('content')
    <div class="container">
        <div class="col-md-4 col-md-offset-2">
            <h3>Thông tin giáo viên</h3>

            @if (isset(Auth::guard('teacher')->user()->name) )
                <p>{!!Auth::guard('teacher')->user()->name!!}</p>
                <p>{!!Auth::guard('teacher')->user()->birthday!!}</p>
                <p>{!!Auth::guard('teacher')->user()->email!!}</p>
            @endif

        </div>
    </div>
@endsection
