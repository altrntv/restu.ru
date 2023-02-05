<div class='container-fluid'>
    <div class='row'>
        <nav id='sidebarMenu' class='col-md-3 col-lg-2 d-md-block bg-light sidebar'>
            <div class='position-sticky pt-3'>
                <ul class='nav flex-column'>

                    <li class='nav-item'>
                        <a class='nav-link d-flex align-content-start {{ Request::is('/') ? 'active' : '' }}' aria-current='page' href='{{ route('index') }}'>
                            <span data-feather='home'></span>
                            <span>Главная</span>
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link d-flex align-content-start {{ Request::is('reports*') ? 'active' : '' }}' aria-current='page' href='{{ route('report.index') }}'>
                            <span data-feather='table'></span>
                            Отчёты
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link d-flex align-content-start {{ Request::is('dashboards*') ? 'active' : '' }}' aria-current='page' href='#'>
                            <span data-feather='bar-chart-2'></span>
                            Dashboards
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link d-flex align-content-start' aria-current='page' href='#'>
                            <span data-feather='tv'></span>
                            Изображения для ТВ
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link d-flex align-content-start' aria-current='page' href='#'>
                            <span data-feather='image'></span>
                            Менюборды
                        </a>
                    </li>
                </ul>

                @if((int) Auth::user()->role === App\Models\User::ROLE_ADMIN)
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>Панель администратора</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-content-start {{ Request::is('admin/organizations*') ? 'active' : '' }}" href="{{ route('admin.organization.index') }}">
                                <span data-feather='grid'></span>
                                Организации
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-content-start {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">
                                <span data-feather='users'></span>
                                Пользователи
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-content-start {{ Request::is('admin/reports*') ? 'active' : '' }}" href="{{ route('admin.report.index') }}">
                                <span data-feather='table'></span>
                                Отчёты
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
        </nav>
    </div>
</div>
