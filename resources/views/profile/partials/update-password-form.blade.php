<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Обновить пароль') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Убедитесь, что в вашей учетной записи используется длинный случайный пароль, чтобы оставаться в безопасности.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">Текущий пароль</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
            @error('current_password')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

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

            @if (session('status') === 'password-updated')
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
