<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="{{ route('index') }}">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Главная
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('reports*') ? 'active' : '' }}" href="{{ route('report.index') }}">
                    <span data-feather="table" class="align-text-bottom"></span>
                    Отчёты
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboards*') ? 'active' : '' }}" href="#">
                    <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                    Dashboards
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Изображения для ТВ
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                    Менюборды
                </a>
            </li>
        </ul>

        @if((int) Auth::user()->role === App\Models\User::ROLE_ADMIN)

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                <span>Вспомогательное</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/reports*') ? 'active' : '' }}" href="{{ route('admin.report.index') }}">
                        <span data-feather='table'></span>
                        Отчёты
                    </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                <span>Панель администратора</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/organizations*') ? 'active' : '' }}" href="{{ route('admin.organization.index') }}">
                        <span data-feather='grid'></span>
                        Организации
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/corporation*') ? 'active' : '' }}" href="{{ route('admin.corporation.index') }}">
                        <span data-feather='grid'></span>
                        Корпорации
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/users*') && !Request::is('admin/users/reports*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">
                        <span data-feather='users'></span>
                        Пользователи
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/users/reports*') ? 'active' : '' }}" href="{{ route('admin.user.report.index') }}">
                        <span data-feather='table'></span>
                        Пользовательские отчёты
                    </a>
                </li>
            </ul>
        @endif
    </div>
</nav>
