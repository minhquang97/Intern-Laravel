@extends('student.layouts.master')
@section('content')
    <div class="container">
        <div class="col-md-4 col-md-offset-2">
            <h3>Thông tin học sinh</h3>

            @if (isset(Auth::guard('student')->user()->name) )
                <p>{!!Auth::guard('student')->user()->name!!}</p>
                <p>{!!Auth::guard('student')->user()->birthday!!}</p>
                <p>{!!Auth::guard('student')->user()->email!!}</p>
                <p>{!!Auth::guard('student')->user()->class!!}</p>
                <p>{!!Auth::guard('student')->user()->address!!}</p>
            @endif

        </div>
    </div>
@endsection
