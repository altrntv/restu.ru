<section>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Информация об отчёте') }}
        </h2>
    </header>

    <form action="{{ route('admin.user.report.update', $report->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Название отчёта</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="" value="{{ old('name', $report->name) }}">
            @error('name')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $report->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="row mb-3">

            <div class="col-md-4">
                <label for="slug" class="form-label">Краткая ссылка</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="example-report" value="{{ old('slug', $report->slug) }}">
                @error('slug')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="icon" class="form-label">Иконка</label>
                <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" placeholder="" value="{{ old('icon', $report->icon) }}">
                @error('icon')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="type_date" class="form-label">Тип даты</label>
                <select class="form-select @error('type_date') is-invalid @enderror" id="type_date" name="type_date">

                    <option value="day"
                        {{ $report->type_date == 'day' ? 'selected' : '' }}
                    >День</option>
                    <option value="range"
                        {{ $report->type_date == 'range' ? 'selected' : '' }}
                    >Диапазон</option>
                    <option value="month"
                        {{ $report->type_date == 'month' ? 'selected' : '' }}
                    >Месяц</option>
                </select>
                @error('type_date')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
                @enderror
            </div>

        </div>

        <div class="mb-3">
            <label for="organization" class="form-label">Организация</label>
            <select class="form-select @error('organization_id') is-invalid @enderror" id="organization" name="organization_id">
                @foreach($organizations as $organization)
                    <option value="{{ $organization->id }}"
                        {{ $organization->id == $report->organization_id ? 'selected' : '' }}
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
            <label for="request_json" class="form-label">JSON API Запроса</label>
            <textarea id="request_json" class="form-control @error('request_json') is-invalid @enderror" name="request_json">{{ old('request_json', $report->request_json) }}</textarea>
            @error('request_json')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="report_json" class="form-label">JSON Параметров отчёта</label>
            <textarea id="report_json" class="form-control @error('report_json') is-invalid @enderror" name="report_json">{{ old('report_json', $report->report_json) }}</textarea>
            @error('report_json')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="row align-items-center">

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Обновить</button>
            </div>

            @if (session('status') === 'report-updated')
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
