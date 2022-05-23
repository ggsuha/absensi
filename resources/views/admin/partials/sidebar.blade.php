<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="https://ui-avatars.com/api/?background=random&name=Tes+User" alt="{{ config('app.name') }}"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.event.index') }}"
                        class="nav-link {{ Route::is('admin.event.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Event
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <div class="sidebar-custom">
        <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
        <a href="{{ route('admin.logout') }}" class="btn btn-danger hide-on-collapse pos-right">Logout</a>
    </div>
    <!-- /.sidebar -->
</aside>
