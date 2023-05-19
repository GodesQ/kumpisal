<div class="member-menu">
    <div class="container">
        <ul>
            <li class="{{ Request::path() == 'user/dashboard' ? 'active' : '' }}"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
            <li><a href="#">Bookings</a></li>
            <li><a href="#">Wishlist</a></li>
            <li class="{{ Request::path() == 'user/profile' ? 'active' : '' }}"><a href="{{ route('user.profile') }}">Profile</a></li>
        </ul>
    </div>
</div>
