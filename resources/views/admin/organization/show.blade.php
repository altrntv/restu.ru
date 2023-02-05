@extends('layouts.app')

@section('title', 'Панель администратора || ' . $organization->name)

@section('content')
    <div class="container px-4 py-5">

        <a href="{{ url()->previous() }}">
            <span class="backspace">
                <span data-feather="arrow-left"></span><span class="back-button">Назад</span>
            </span>
        </a>

        <div class="row">
            <h2 class="pb-2 border-bottom">
                <span>Просмотр организации</span>
            </h2>
        </div>

        <div class="col-md-7 col-lg-7">

            <div class="mb-4">
                @include('admin.organization.partials.update-organization-information')
            </div>

            <div class="mb-4">
                @include('admin.organization.partials.update-organization-password')
            </div>

            <div class="mb-4">
                @include('admin.organization.partials.delete-organization')
            </div>

        </div>

    </div>


@endsection
