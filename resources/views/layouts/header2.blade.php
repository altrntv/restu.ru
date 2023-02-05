<header class='navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow'>
    <a class='navbar-brand col-md-3 col-lg-2 me-0 px-3' href='/'>{{ Auth::user()->organization->name }}</a>
    <button class='navbar-toggler position-absolute d-md-none collapsed' type='button' data-bs-toggle='collapse'
            data-bs-target='#sidebarMenu' aria-controls='sidebarMenu' aria-expanded='false'
            aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <input class='form-control form-control-dark w-100' type='text' placeholder='Поиск' aria-label='Search'>
    <div class='navbar-nav flex-row'>
        <div class='nav-item text-nowrap'>
            <a class='nav-link px-3' href='{{ route('profile.edit') }}'>{{ Auth::user()->name }}</a>
        </div>
        <div class='nav-item text-nowrap'>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <input type="submit" class="nav-link px-3" onclick="event.preventDefault(); this.closest('form').submit();" value="{{ __('Выход') }}" />
            </form>

        </div>
    </div>
</header>
