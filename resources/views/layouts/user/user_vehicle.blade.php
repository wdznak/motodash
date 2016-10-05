@extends('layouts.app')
@include('layouts.user.user_header')

@section('content')
<div class="body-container">
  <div class="container">

        @yield('header')

        <div class="row">
            <div class="col-sm-3 col-sm-offset-1 user-home-panel">
                <div class="user-panel">
                    <div class="panel-header">
                        {{ $vehicleDetails['brand'] . ' ' . $vehicleDetails['model'] . ' ' . $vehicleDetails['version'] }}
                    </div>

                    <div class="details">

                        <ul class="list-group">
                            <li class="list-group-item sm">
                                Mileage {{ $vehicleDetails['mileage'] }}
                            </li>
                            <li class="list-group-item sm">
                                Engine size {{ $vehicleDetails['engine'] }}
                            </li>
                        </ul>

                        @can('modify-userVehicle', $vehicleDetails['id'])
                            <div class="control-btn-set">
                                <button
                                    class="btn btn-info btn-sm"
                                    type="button"
                                    name="refuel"
                                    @click="toggleRefuelForm"
                                >
                                    Refuel
                                </button>
                                <button class="btn btn-info btn-sm"
                                        type="button"
                                        name="modification"
                                        @click="toggleModificationForm"
                                >
                                    Modification
                                </button>
                                <form id="delete-vehicle"
                                      action="{{ route('user.uservehicle.destroy', ['userId' => $vehicleDetails['userId'], 'id' => $vehicleDetails['id']]) }}"
                                      method="post"
                                >
                                    {{ csrf_field() }}
                                    <input type="hidden"
                                           name="_method"
                                           value="DELETE"
                                    >
                                    <input type="submit"
                                           class="btn btn-danger btn-sm"
                                           name="Delete"
                                           value="Delete">
                                </form>
                            </div>
                        @endcan

                    </div>
                </div>

                <user-vehicle-modifications modifications="{{ json_encode($vehicleDetails['modifications']) }}"
                                            counter="{{ $vehicleDetails['counters']['modifications'] }}"
                >
                </user-vehicle-modifications>

                <user-vehicle-refuels refuels="{{ json_encode($vehicleDetails['refuels']) }}"
                                      counter="{{ $vehicleDetails['counters']['refuels'] }}"
                >
                </user-vehicle-refuels>

            </div>

            <div class="col-sm-7 user-home-body">
                <refuel-form action="{{ route('uservehicle.refuel.store', ['vehicleId' => $vehicleDetails['id']]) }}" ></refuel-form>
                <modification-form action="{{ route('uservehicle.modification.store', ['vehicleId' => $vehicleDetails['id']]) }}"></modification-form>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="user-panel">

                    <div class="panel-header">
                        Comments<br>
                    </div>

                    <div class="scrollable">

                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="item-container">
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src=" {{ asset('js/uservehicle.js') }}"></script>
@endsection
