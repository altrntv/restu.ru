<section>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Информация о пользователе') }}
        </h2>
    </header>

    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
            @error('name')
            <div class="d-block invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email адрес</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
            @error('email')
            <div class="d-block invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="organization" class="form-label">Организация</label>
            <select class="form-select @error('organization_id') is-invalid @enderror" id="organization" name="organization_id">
                @foreach($organizations as $organization)
                    <option value="{{ $organization->id }}"
                        {{ $organization->id == $user->organization_id ? 'selected' : '' }}
                    >{{ $organization->name }}</option>
                @endforeach
            </select>
            @error('organization_id')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Права пользователя</label>
            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                @foreach($roles as $id => $role)
                    <option value="{{ $id }}"
                        {{ $id == $user->role ? 'selected' : '' }}
                    >{{ $role }}</option>
                @endforeach
            </select>
            @error('role')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="row align-items-center">

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Обновить</button>
            </div>

            @if (session('status') === 'user-updated')
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
