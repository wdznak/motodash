@extends('layouts.app')
@include('widgets.pick_vehicle')
@include('layouts.user.user_header')

@section('content')
<div class="body-container">
    <div class="container">

        @yield('header')

        <div id="vehicleList"
             class="row"
        >
            <div class="col-sm-3 col-sm-offset-1 user-home-panel">

                <div class="user-panel">
                    <div class="panel-header">
                        Your Vehicles
                        <button class="btn btn-default btn-xs" id="lightbox-btn"
                                type="button"
                                name="new"
                        >
                                <i class=" glyphicon glyphicon-plus"></i>New
                        </button>
                    </div>

                    <user-vehicles base-url="{{ route('user.uservehicle.index', ['user' => Auth::id()]) }}"></user-vehicles>
                </div>

            </div>

            <div id="test"
                 class="col-sm-7 user-home-body"
            >
                <form action="{{ route('user.destroy', ['user' => Auth::id()]) }}"
                      method="GET"
                >

                    <input class="btn btn-danger btn-sm"
                           type="submit"
                           value="Remove"
                    >
                </form>
            </div>
        </div>
    </div>
</div>

<div class="lightbox is-fixed display-none" id="lightbox">
    <div class="lightbox-container">
        <div class="box">
            <div class="add-vehicle-form">

                <pick-vehicle-form></pick-vehicle-form>
                <user-vehicle-form :vehicle-id="vehicleId"
                                   url="{{ route('user.uservehicle.store', ['user' => Auth::id()]) }}"
                >
                </user-vehicle-form>

            </div>
        </div>
    </div>
</div>

<script src=" {{ asset('js/lightbox.min.js') }} "></script>
<script src=" {{ asset('js/userhome.js') }}"></script>
@endsection
