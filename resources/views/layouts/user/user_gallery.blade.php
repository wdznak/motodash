@extends('layouts.app')
@include('layouts.user.user_header')

@section('content')
<div class="body-container">
    <div class="container">

        @yield('header')

        <div class="row">
            <div class="col-sm-3 col-sm-offset-1 user-home-panel">
                <button class="btn btn-info"
                        type="button"
                        name="button"
                >
                    <i class=" glyphicon glyphicon-plus"></i>Create album
                </button>
            </div>

            <div class="col-sm-7 user-home-body">
            </div>
        </div>

    </div>
</div>
@endsection
