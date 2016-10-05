@extends('layouts.app')

@section('content')
<div class="body-container">
    <div class="container main-container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 gallery-box">
                <div class="bottom-bar">
                    <div class="left-info">
                        <a href="#">
                            <img class="img-href"
                                 src="{{ asset('storage/userGallery/default/dog')}}"
                                 alt="User Logo"
                            >
                            <em>wdmeister</em>
                        </a>
                    </div>
                    <div class="right-info">
                        <a href="#">
                            <i class="glyphicon glyphicon-thumbs-up"></i>Like
                        </a>
                        <a href="#">
                            <i class="glyphicon glyphicon-share"></i>Share
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <hr>
                <div class="content-info">
                    <a href="">
                        <div class="item1">
                            <img class="img-href"
                                 src="{{ url('../resources/assets/graphics/mainpage/mini1.jpg')}}"
                            >
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                        </div>
                    </a>
                    <a href="">
                        <div class="item2">
                            <img class="img-href"
                                 src="{{ url('../resources/assets/graphics/mainpage/mini2.jpg')}}"
                            >
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                        </div>
                    </a>
                    <a href="">
                        <div class="item3">
                            <img class="img-href"
                                 src="{{ url('../resources/assets/graphics/mainpage/mini3.jpg')}}"
                            >
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                        </div>
                    </a>
                </div>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 page-header">

                <em class="emek">Lorem ipsum dolor sit amet</em>, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
        </div>
    </div>
</div>

<script>
    $('.gallery-box').on('click', function(){
        $(this).css({'background-image': 'url("http://placehold.it/975x400/fec1bd?text=Wonderful+Site!")'});
        console.log('click');
    });
</script>

@endsection
