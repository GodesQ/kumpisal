<div class="member-menu">
    <div class="container">
        <ul>
            <li class="{{ Request::path() == 'representative/dashboard' ? 'active' : '' }}"><a href="{{ route('representative.dashboard') }}">Dashboard</a></li>
            <li class=""><a href="{{ route('representative.church_profile', optional(auth()->user()->representative_info->church)->church_uuid) }}">Church Info</a></li>
            <li class="{{ Request::path() == 'representative/profile' ? 'active' : '' }}"><a href="{{ route('representative.profile') }}">Profile</a></li>
        </ul>
    </div>
</div>
