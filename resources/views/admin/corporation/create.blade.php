@extends('layouts.app')

@section('title', 'Панель администратора || Новая корпорация')

@section('content')
    <div class="container px-4 py-5">

        <a href="{{ url()->previous() }}">
            <span class="backspace">
                <span data-feather="arrow-left"></span><span class="back-button">Назад</span>
            </span>
        </a>

        <div class="row">
            <h2 class="pb-2 border-bottom">
                <span>Новая корпорации</span>
            </h2>
        </div>

        <div class="col-md-7 col-lg-7">

            <form action="{{ route('admin.corporation.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Название корпорации</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Resta.Labs" value="{{ old('name') }}">
                    @error('name')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Краткая ссылка</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="resta-labs" value="{{ old('slug') }}">
                    @error('slug')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="server" class="form-label">Сервер</label>
                    <input type="text" class="form-control @error('server') is-invalid @enderror" id="server" name="server" placeholder="https://domen.com:443/resto" value="{{ old('server') }}">
                    @error('server')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" value="{{ old('login') }}">
                    @error('login')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>

    </div>


@endsection
