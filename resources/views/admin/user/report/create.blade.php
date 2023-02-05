@extends('layouts.app')

@section('title', 'Панель администратора || Новый отчёт')

@section('content')
    <div class="container px-4 py-5">

        <a href="{{ url()->previous() }}">
            <span class="backspace">
                <span data-feather="arrow-left"></span><span class="back-button">Назад</span>
            </span>
        </a>

        <div class="row">
            <h2 class="pb-2 border-bottom">
                <span>Новый отчёт</span>
            </h2>
        </div>

        <div class="col-md-7 col-lg-7">

            <form action="{{ route('admin.user.report.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Название отчёта</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row mb-3">

                    <div class="col-md-4">
                        <label for="slug" class="form-label">Краткая ссылка</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="example-report" value="{{ old('slug') }}">
                        @error('slug')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="icon" class="form-label">Иконка</label>
                        <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" placeholder="" value="{{ old('icon') }}">
                        @error('icon')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="type_date" class="form-label">Тип даты</label>
                        <select class="form-select @error('type_date') is-invalid @enderror" id="type_date" name="type_date">
                            <option value="day">День</option>
                            <option value="range">Диапазон</option>
                            <option value="month">Месяц</option>
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
                            <option value="{{ $organization->id }}">{{ $organization->name }}</option>
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
                    <textarea id="request_json" class="form-control @error('request_json') is-invalid @enderror" name="request_json">{{ old('request_json') }}</textarea>
                    @error('request_json')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="report_json" class="form-label">JSON Параметров отчёта</label>
                    <textarea id="report_json" class="form-control @error('report_json') is-invalid @enderror" name="report_json">{{ old('report_json') }}</textarea>
                    @error('report_json')
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
