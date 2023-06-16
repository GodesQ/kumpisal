<div class="member-menu">
    <div class="container">
        <ul>
            <li class="{{ Request::path() == 'user/dashboard' ? 'active' : '' }}"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
            <li class="{{ Request::path() == 'user/profile' ? 'active' : '' }}"><a href="{{ route('user.profile') }}">Profile</a></li>
            <li class="{{ Request::path() == 'user/saved-churches/list' ? 'active' : '' }}"><a href="{{ route('user.saved_churches.list') }}">Saved Churches</a></li>
        </ul>
    </div>
</div>
