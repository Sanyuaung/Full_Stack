<nav class="mb-1 navbar navbar-expand-lg navbar-dark pink sticky-top">
    <a class="navbar-brand" href="{{ route('home') }}">Social App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
        aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ request()->path() === '/' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item {{ request()->path() === 'user/createpost' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('createpost') }}">Create Post</a>
            </li>
            {{-- from AuthServiceProvider --}}
            @can('admin')
                <li class="nav-item {{ request()->path() === 'admin/index' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.home') }}">Admin Control</a>
                </li>
            @endcan
            <li class="nav-item {{ request()->path() === 'user/contactus' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('contactus') }}">Contact Us</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item avatar dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('images/profiles/' . auth()->user()->image) }}"
                        class="rounded-circle z-depth-0" alt="avatar image" height="40px" width="40px">
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
                    aria-labelledby="navbarDropdownMenuLink-55">
                    <a class="dropdown-item" href="{{ route('userprofile') }}">{{ auth()->user()->name }}</a>
                    <label class="ml-2">
                        @if (auth()->user()->isPremium == '1' && auth()->user()->isAdmin == '0')
                            <p>Premium User</p>
                        @endif
                        @if (auth()->user()->isAdmin == '1' && auth()->user()->isPremium == '0')
                            <p>Admin User</p>
                        @endif
                        @if (auth()->user()->isAdmin == '0' && auth()->user()->isPremium == '0')
                            <p>Normal User</p>
                        @endif
                        @if (auth()->user()->isAdmin == '1' && auth()->user()->isPremium == '1')
                            <p>All User</p>
                        @endif
                    </label>

                    <a class="dropdown-item" href="{{ route('userprofile') }}">User Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
