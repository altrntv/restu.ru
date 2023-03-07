{{--@extends('layouts.app')--}}

{{--@section('title', $menuboard->organization->name . " :: " . $menuboard->name)--}}

{{--@section('content')--}}

{{--        <div class="container px-4 py-5" id="hanging-icons">--}}

{{--            <a href="{{ url()->previous() }}">--}}
{{--                <span class="backspace">--}}
{{--                    <span data-feather="arrow-left"></span><span class="back-button">Назад</span>--}}
{{--                </span>--}}
{{--            </a>--}}

{{--            <div class="row">--}}
{{--                <h2 class="pb-2 border-bottom">--}}
{{--                    <span>{{ $menuboard->organization->name . " :: " . $menuboard->name }}</span>--}}
{{--                </h2>--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                @foreach($nomenclature as $product)--}}
{{--                    <div>{{ $product->name }} : {{ $product->price }} рублей</div>--}}
{{--                @endforeach--}}
{{--            </div>--}}

{{--            </div>--}}

{{--        </div>--}}


{{--@endsection--}}

{{--@section('footer')--}}

{{--@endsection--}}

@include('menuboard.partials.'.$menuboard->id)

