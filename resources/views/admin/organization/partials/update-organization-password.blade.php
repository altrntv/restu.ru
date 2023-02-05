<section>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Обновить пароль') }}
        </h2>
    </header>

    <form method="post" action="{{ route('admin.organization.update.password', $organization->id) }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="password" class="form-label">Новый пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Подтвердить пароль</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="row align-items-center">

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Обновить</button>
            </div>

            @if (session('status') === 'organization-password-updated')
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
