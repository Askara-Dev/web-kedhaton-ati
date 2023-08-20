<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link {{ set_active('dashboard.index') }}" href="{{ route('dashboard.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Master</div>

            {{-- Posts --}}
            @can('manage_posts')
                <a class="nav-link {{ set_active(['posts.index', 'posts.create', 'posts.edit', 'posts.show']) }}"
                    href="{{ route('posts.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="far fa-newspaper"></i>
                    </div>
                    Posts
                </a>
            @endcan
            {{-- Categories --}}
            @can('manage_categories')
                <a class="nav-link
            {{ set_active(['categories.index', 'categories.create', 'categories.edit', 'categories.show']) }}"
                    href="{{ route('categories.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-bookmark"></i>
                    </div>
                    Categories
                </a>
            @endcan
            {{-- Tags --}}
            @can('manage_tags')
                <a class="nav-link {{ set_active(['tags.index', 'tags.create', 'tags.edit']) }} "
                    href="{{ route('tags.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    Tags
                </a>
            @endcan
            {{-- User --}}
            <div class="sb-sidenav-menu-heading">User permission</div>
            <a class="nav-link {{ set_active(['users.index', 'users.create', 'users.edit']) }}"
                href="{{ route('users.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-user"></i>
                </div>
                User
            </a>
            {{-- Role --}}
            <a class="nav-link {{ set_active(['roles.index', 'roles.show', 'roles.create', 'roles.edit']) }}"
                href="{{ route('roles.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                Role
            </a>
            <div class="sb-sidenav-menu-heading">Settings</div>
            {{-- Filemanager --}}
            <a class="nav-link {{ set_active(['filemanager.index']) }}" href="{{ route('filemanager.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-photo-video"></i>
                </div>
                File Manager
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        <!-- show username -->
        {{ Auth::user()->name }}
    </div>
</nav>
