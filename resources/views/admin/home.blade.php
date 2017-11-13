@extends('admin.layouts.master')
@section('content')
    <div class="container">
        <div class="col-md-4 col-md-offset-2">
            <h3>Thông tin người quản lý</h3>

                @if (isset(Auth::guard('admin')->user()->name) )
                <p>{!!Auth::guard('admin')->user()->name!!}</p>
                @endif

        </div>
    </div>
@endsection
