@extends('layouts.app')

@section('title', 'Главная')

@section('header')
    <style>
        .icon-main .feather {
            width: 32px;
            height: 32px;
        }
    </style>
@endsection

@section('content')
    <div class="px-4 py-5">

        <div class="pb-5">
            <div class="row g-4">
                <div class="col-12 col-xxl-6">
                    <div class="mb-8">
                        <h2 class="mb-2">Dashboard</h2>
                        <h5 class="text-700 fw-semi-bold">Here’s what’s going on at your business right now</h5>
                    </div>
                    <div class="row align-items-center g-4">
                        <div class="col-12 col-md-auto">
                            <div class="d-flex align-items-center icon-main">
                                <span data-feather="shopping-bag" class="align-text-bottom"></span>
                                <div class="ms-3">
                                    <h4 class="mb-0">57 new orders</h4>
                                    <p class="text-800 fs--1 mb-0">Awating processing</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-auto">
                            <div class="d-flex align-items-center icon-main">
                                <span data-feather="dollar-sign" class="align-text-bottom"></span>
                                <div class="ms-3">
                                    <h4 class="mb-0">5 orders</h4>
                                    <p class="text-800 fs--1 mb-0">On hold</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-auto">
                            <div class="d-flex align-items-center icon-main">
                                <span data-feather="truck" class="align-text-bottom"></span>
                                <div class="ms-3">
                                    <h4 class="mb-0">15 products</h4>
                                    <p class="text-800 fs--1 mb-0">Out of stock</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-12 col-xxl-6"></div>
            </div>
        </div>

    </div>
@endsection

@section('footer')

@endsection
