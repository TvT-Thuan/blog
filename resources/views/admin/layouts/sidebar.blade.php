<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        {{-- list user --}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List user</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add user</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- list category --}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                    Categories
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.categories.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add category</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- list post --}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-newspaper"></i>
                <p>
                    Posts
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List post</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.posts.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add post</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- list commnet --}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-comments"></i>
                <p>
                    Comments
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.comments.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List comment</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.comments.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add commnet</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- list contact --}}
        <li class="nav-item">
            <a href="{{ route('admin.contacts.index') }}" class="nav-link">
                <i class="nav-icon fas fa-inbox"></i>
                <p>
                    Contacts
                </p>
            </a>
        </li>
        {{-- logout --}}
        <li class="nav-item">
            <a href="{{ route('auth.logout') }}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Layout Options
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">6</span>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="../layout/top-nav.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Top Navigation</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../layout/top-nav-sidebar.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Top Navigation + Sidebar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../layout/boxed.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Boxed</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../layout/fixed-sidebar.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fixed Sidebar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../layout/fixed-sidebar-custom.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fixed Sidebar <small>+ Custom Area</small></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../layout/fixed-topnav.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fixed Navbar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../layout/fixed-footer.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fixed Footer</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../layout/collapsed-sidebar.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Collapsed Sidebar</p>
                    </a>
                </li>
            </ul>
        </li> --}}
    </ul>
</nav>
