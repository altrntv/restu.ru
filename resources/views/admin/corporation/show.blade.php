@extends('layouts.app')

@section('title', 'Панель администратора || ' . $corporation->name)

@section('content')
    <div class="container px-4 py-5">

        <a href="{{ url()->previous() }}">
            <span class="backspace">
                <span data-feather="arrow-left"></span><span class="back-button">Назад</span>
            </span>
        </a>

        <div class="row">
            <h2 class="pb-2 border-bottom">
                <span>Просмотр корпорации</span>
            </h2>
        </div>

        <div class="col-md-7 col-lg-7">

            <div class="mb-4">
                @include('admin.corporation.partials.update-corporation-information')
            </div>

            <div class="mb-4">
                @include('admin.corporation.partials.update-corporation-password')
            </div>

            <div class="mb-4">
                @include('admin.corporation.partials.delete-corporation')
            </div>

        </div>

    </div>

@endsection
