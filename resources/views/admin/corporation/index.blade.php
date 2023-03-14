@extends('layouts.app')

@section('title', 'Панель администратора || Корпорации')

@section('content')
    <div class="container px-4 py-5">

        <div class="row">
            <h2 class="pb-2 border-bottom">
                <span>Корпорации</span>
                <a href='{{ route('admin.corporation.create') }}' class="btn btn-primary btn-sm">Добавить</a>
            </h2>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Название</th>
                    <th scope="col">Краткая ссылка</th>
                    <th scope="col">Логин</th>
                    <th scope="col">Сервер</th>
                </tr>
                </thead>
                <tbody>
                @if(!$corporations->isEmpty())
                    @foreach($corporations as $corporation)
                        <tr>
                            <th scope="row">{{ $corporation->id }}</th>
                            <td><a href="{{ route('admin.corporation.show', $corporation->id) }}">{{ $corporation->name }}</a></td>
                            <td>{{ $corporation->slug }}</td>
                            <td>{{ $corporation->login }}</td>
                            <td>{{ $corporation->server }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" align="center">Корпораций нет</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
