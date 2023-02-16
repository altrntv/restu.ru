@extends('layouts.app')

@section('title', 'Панель администратора || Менюборды')

@section('content')
    <div class="container px-4 py-5">

        <div class="row">
            <h2 class="pb-2 border-bottom">
                <span>Пользовательские менюборды</span>
                <a href='{{ route('admin.user.menuboard.create') }}' class="btn btn-primary btn-sm">Добавить</a>
            </h2>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Организация</th>
                    <th scope="col">Название</th>
                    <th scope="col">Добавлен</th>
                    <th scope="col">Последняя активность</th>
                    <th scope="col">Ссылка</th>
                </tr>
                </thead>
                <tbody>
                @if(!$menuboards->isEmpty())
                    @foreach($menuboards as $menuboard)
                        <tr>
                            <th scope="row">{{ $menuboard->id }}</th>
                            <td>{{ $menuboard->organization->name }}</td>
                            <td>{{ $menuboard->name }}</td>
                            <td>{{ $menuboard->created_at }}</td>
                            <td>{{ $menuboard->actived_at }}</td>
                            <td><a href="{{ route('admin.user.menuboard.show', $menuboard->id) }}">Настроить</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" align="center">Менюбордов нет</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
