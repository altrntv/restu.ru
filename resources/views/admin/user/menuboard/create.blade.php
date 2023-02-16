@extends('layouts.app')

@section('title', 'Панель администратора || Новый менюборд')

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
