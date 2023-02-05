@extends('layouts.app')

@section('title', 'Панель администратора || Организации')

@section('content')
    <div class="container px-4 py-5">

        <div class="row">
            <h2 class="pb-2 border-bottom">
                <span>Организации</span>
                <a href='{{ route('admin.organization.create') }}' class="btn btn-primary btn-sm">Добавить</a>
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
                @if(!$organizations->isEmpty())
                    @foreach($organizations as $organization)
                        <tr>
                            <th scope="row">{{ $organization->id }}</th>
                            <td><a href="{{ route('admin.organization.show', $organization->id) }}">{{ $organization->name }}</a></td>
                            <td>{{ $organization->slug }}</td>
                            <td>{{ $organization->login }}</td>
                            <td>{{ $organization->server }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" align="center">Организаций нет</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
