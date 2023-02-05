@extends('layouts.app')

@section('title', 'Панель администратора || Пользователи')

@section('content')
    <div class="container px-4 py-5">

        <div class="row">
            <h2 class="pb-2 border-bottom">
                <span>Пользователи</span>
                <a href='{{ route('admin.user.create') }}' class="btn btn-primary btn-sm">Добавить</a>
            </h2>
        </div>

        <div class="table-responsive">
            <table class="table table-hover w-50">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Email</th>
                    <th scope="col">Организация</th>
                    <th scope="col">Права</th>
                </tr>
                </thead>
                <tbody>
                @if(!$users->isEmpty())
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td><a href="{{ route('admin.user.show', $user->id) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->organization->name }}</td>
                            <td>{{ \App\Models\User::getRoles()[$user->role] }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" align="center">Пользователей нет</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
