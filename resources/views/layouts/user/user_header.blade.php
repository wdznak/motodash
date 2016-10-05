@section('header')
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="cover-content">
            <img class="cover-pic"
                 src="{{ url('../resources/assets/graphics/moto.jpg')}}"
                 alt="Cover Picture"
            />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1 profile-nav-col">
        <div class="profile-nav-container">

            <div class="profile-pic">
                <img class="pic"
                     src="{{ url('../resources/assets/graphics/mainpage/mini2.jpg')}}"
                     alt="Profile Picture"
                />
            </div>
            <ul class="nav nav-tabs">
                <li role="presentation" class="active">
                    <a href="#">Dashboard</a>
                </li>
                <li role="presentation">
                    <a href="#">About</a>
                </li>
                <li role="presentation">
                    <a href="#">Gallery</a>
                </li>
                <li role="presentation">
                    <a href="#">Options</a>
                </li>
                <li role="presentation">
                    <a href="#">Help</a>
                </li>
            </ul>

        </div>
    </div>
</div>
@endsection
