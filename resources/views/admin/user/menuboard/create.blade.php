@extends('layouts.app')

@section('title', 'Панель администратора || Новый менюборд')

@section('header')
    <!-- Styles select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('content')
    <div class="container px-4 py-5">

        <a href="{{ url()->previous() }}">
            <span class="backspace">
                <span data-feather="arrow-left"></span><span class="back-button">Назад</span>
            </span>
        </a>

        <div class="row">
            <h2 class="pb-2 border-bottom">
                <span>Новый менюборд</span>
            </h2>
        </div>

        <div class="col-md-7 col-lg-7">

            <form action="{{ route('admin.user.menuboard.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Название менюборда</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="menu_json" class="form-label">Блюда (JSON формат)</label>
                    <textarea id="menu_json" class="form-control @error('menu_json') is-invalid @enderror" name="menu_json">{{ old('menu_json') }}</textarea>
                    @error('menu_json')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="menu" class="form-label">Список позиций</label>
                    <select class="form-select @error('menu') is-invalid @enderror" id="multiple-select-field" name="menu[]" data-placeholder="Выберете позиции" multiple>
                        @foreach($nomenclatures as $nomenclature)
                            <option value="{{ $nomenclature->id }}">{{ $nomenclature->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="organization" class="form-label">Организация</label>
                    <select class="form-select @error('organization_id') is-invalid @enderror" id="organization" name="organization_id">
                        @foreach($organizations as $organization)
                            <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                        @endforeach
                    </select>
                    @error('organization_id')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>

    </div>

@endsection

@section('footer')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // For Select2 4.1
        $("#multiple-select-field").select2({
            theme: "bootstrap-5",
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
            closeOnSelect: false
        });
    </script>
@endsection
