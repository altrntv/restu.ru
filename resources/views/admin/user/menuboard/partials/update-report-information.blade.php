<section>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Информация о менюборде') }}
        </h2>
    </header>

    <form action="{{ route('admin.user.menuboard.update', $menuboard->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Название менюборда</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="" value="{{ old('name', $menuboard->name) }}">
            @error('name')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="organization" class="form-label">Организация</label>
            <select class="form-select @error('organization_id') is-invalid @enderror" id="organization" name="organization_id">
                @foreach($organizations as $organization)
                    <option value="{{ $organization->id }}"
                        {{ $organization->id == $menuboard->organization_id ? 'selected' : '' }}
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
            <label for="menu_json" class="form-label">Блюда (JSON формат)</label>
            <textarea id="menu_json" class="form-control @error('menu_json') is-invalid @enderror" name="menu_json">{{ old('menu_json', $menuboard->menu_json) }}</textarea>
            @error('menu_json')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="row align-items-center">

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Обновить</button>
            </div>

            @if (session('status') === 'menuboard-updated')
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
