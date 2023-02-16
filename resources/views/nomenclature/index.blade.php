@extends('layouts.app')

@section('title', 'Номенклатура')

@section('content')
    <div class="container px-4 py-5">
        <div class="row">
            <h2 class="pb-2 border-bottom">
                <span>Номенклатура</span>
                <a href='{{ route('nomenclature.update') }}' class="btn btn-primary btn-sm">Обновить</a>
            </h2>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Название</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Артикул</th>
                    <th scope="col">Добавлена</th>
                    <th scope="col">Обнавлена</th>
                </tr>
                </thead>
                <tbody>
                @if(!$nomenclatures->isEmpty())
                    @foreach($nomenclatures as $nomenclature)
                        <tr>
                            <th scope="row">{{ $nomenclature->id }}</th>
                            <td>{{ $nomenclature->name }}</td>
                            <td>{{ $nomenclature->price }} руб.</td>
                            <td>{{ $nomenclature->code }}</td>
                            <td>{{ $nomenclature->created_at }}</td>
                            <td>{{ $nomenclature->updated_at }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" align="center">Список пуст</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection
