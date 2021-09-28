<header id="site-header" class="site-header" role="banner">
    <div class="container">
        <div class="site-logo-wrap">
            <hgroup>
                <h1 class='site-title site-title-no-desc'> <a  style="color:#FFFFFF;" href='{{ route('homepage') }}' title='{{ config('app.name', 'foodtrucks') }}' rel='home'>{{ config('app.name', 'Food truckes traker') }}</a></h1>
            </hgroup>
        </div>
        <nav id="primary-nav" class="primary-nav" role="navigation">
            <ul id="menu-gd-menu" class="menu">
                @guest
                    <li class="gd-menu-item menu-item menu-item-type-post_type_archive"><a href="{{ route('login') }}">Login</a></li>
                    <li class="gd-menu-item menu-item menu-item-type-post_type_archive"><a href="{{ route('register') }}">Register</a></li>
                @else
                @if(Auth::user()->food_truck_id==null)
                    <li class="gd-menu-item menu-item menu-item-type-post_type_archive"><a href="{{ route('admin.food-trucks.create') }}">Add My Truck</a></li>
                    @endif
                    @if(Auth::user()->is_admin ||Auth::user()->is_owner)
                    <li class="gd-menu-item menu-item menu-item-type-post_type_archive"><a href="{{ route('admin.home') }}">Dashboard</a></li>
@endif
<li class="gd-menu-item menu-item menu-item-type-post_type_archive"><a href="{{ route('profile.password.edit') }}">Profille</a></li>

                    <li class="gd-menu-item menu-item menu-item-type-post_type_archive"><a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a></li>
                    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endguest
            </ul>
        </nav>
        <div class="dt-nav-toggle  dt-mobile-nav-button-wrap"><a href="#primary-nav"><i class="fas fa-bars"></i></a></div>
    </div>
</header>
