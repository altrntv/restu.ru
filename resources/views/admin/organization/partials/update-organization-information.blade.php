<section>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Информация об организации') }}
        </h2>
    </header>

    <form action="{{ route('admin.organization.update', $organization->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Название организации</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Resta.Labs" value="{{ old('name', $organization->name) }}">
            @error('name')
            <div class="d-block invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Краткая ссылка</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="resta-labs" value="{{ old('slug', $organization->slug) }}">
            @error('slug')
            <div class="d-block invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="server" class="form-label">Сервер</label>
            <input type="text" class="form-control @error('server') is-invalid @enderror" id="server" name="server" placeholder="https://domen.com:443/resto" value="{{ old('server', $organization->server) }}">
            @error('server')
            <div class="d-block invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" value="{{ old('login', $organization->login) }}">
            @error('login')
            <div class="d-block invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="row align-items-center">

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Обновить</button>
            </div>

            @if (session('status') === 'organization-updated')
                <div class="col-auto">
                        <span id="passwordHelpInline" class="form-text"
                              x-data="{ show: true }"
                              x-show="show"
                              x-transition
                              x-init="setTimeout(() => show = false, 2000)"
                              class="text-sm text-gray-600"
                        >
                          Сохранено.
                        </span>
                </div>
            @endif
        </div>
    </form>

</section>
