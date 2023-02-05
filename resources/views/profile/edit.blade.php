@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="container px-4 py-5">
        <div class="row">
            <h2 class="pb-2 border-bottom">Профиль</h2>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="mb-4">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="mb-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>


    </div>
@endsection
