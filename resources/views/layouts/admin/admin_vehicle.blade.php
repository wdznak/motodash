@extends('layouts.app')
@include('widgets.pick_vehicle')

@section('content')
<div class="body-container">
  <div class="container">
    <p class="paragraf"></p>
    <div class="row">
        <div class="col-sm-6">

            <button type="button" class="btn btn-success btn-xs" name="car_form_btn" id="car_form_btn">Add Car</button>
            <div class="car-form row" style="display:none">
                <div class="col-sm-6">
                    @yield('form')
                </div>
                <div class="col-sm-6">
                    <form role="form" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="Type">Type</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="Enter vehicle type">
                        </div>
                        <div class="form-group">
                            <label for="Brand">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter vehicle brand">
                        </div>
                        <div class="form-group">
                            <label for="Model">Model</label>
                            <input type="text" class="form-control" id="model" name="model" placeholder="Enter vehicle model">
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="Produced from">Produced from</label>
                                <input type="number" class="form-control" id="yearFrom" name="yearFrom" placeholder="Enter vehicle production year">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="Produced until">Produced until</label>
                                <input type="number" class="form-control" id="yearUntil" name="yearUntil" placeholder="Enter vehicle production year">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm" formaction="{{ url('admin/vehicles/create') }}">Add</button>
                        <button type="submit" class="btn btn-warning btn-sm" formaction="{{ url('admin/vehicles/update') }}">Update</button>
                    </form>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            abc
        </div>
    </div>
  </div>
</div>

<script>
    $( document ).ready( function()
    {
        var carFormBtn = $("button#car_form_btn");
        carFormBtn.click( function()
        {
            var visible = $('.car-form').is(':visible');
            if (visible)  {
                $(".car-form").css("display", "none");
                carFormBtn.toggleClass("btn-default btn-success");
                carFormBtn.html("Add Car");
            }else {
                $(".car-form").css("display", "inline");
                carFormBtn.toggleClass("btn-success btn-default");
                carFormBtn.html('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>');
            }
        });

        $("#vehicle_form").on("change", function (e)
        {
            var optVal = e.target.value;
            var changed_form_id = e.originalEvent.target.id;

            switch (changed_form_id)
            {
                case 'vehicle_type':
                    $('#type').val(optVal);
                break;
                case 'vehicle_brand':
                    $('#brand').val(optVal);
                break;
                case 'vehicle_model':
                    $('#model').val(optVal);
                break;
                default:
            }
        });
    });
</script>
@endsection
