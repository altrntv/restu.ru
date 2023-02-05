@extends('layouts.app')

@section('title', 'Панель администратора || Отчёты')

@section('content')
    <div class="container px-4 py-5">

        <div class="row">
            <h2 class="pb-2 border-bottom">
                <span>Пользовательские отчёты</span>
                <a href='{{ route('admin.user.report.create') }}' class="btn btn-primary btn-sm">Добавить</a>
            </h2>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Организация</th>
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Краткая ссылка</th>
                    <th scope="col">Иконка</th>
                    <th scope="col">Тип даты</th>
                </tr>
                </thead>
                <tbody>
                @if(!$reports->isEmpty())
                    @foreach($reports as $report)
                        <tr>
                            <th scope="row">{{ $report->id }}</th>
                            <td>{{ $report->organization->name }}</td>
                            <td><a href="{{ route('admin.user.report.show', $report->id) }}">{{ $report->name }}</a></td>
                            <td>{{ $report->description }}</td>
                            <td>{{ $report->slug }}</td>
                            <td>{{ $report->icon }}</td>
                            <td>{{ $report->type_date }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" align="center">Отчётов нет</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
