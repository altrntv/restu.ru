@extends('layouts.app')

@section('title', 'Отчёты')

@section('content')
    <div class="container px-4 py-5">
        <div class="row">
            <h2 class="pb-2 border-bottom">Отчёты</h2>
        </div>

        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">

            @if(!$reports->isEmpty())
                @foreach($reports as $report)

                    <div>
                        @if((int) Auth::user()->role === App\Models\User::ROLE_ADMIN)
                            <span class="form-text" style="margin-left: 5rem">{{ $report->organization->name }}</span>
                        @endif
                        <div class='col d-flex align-items-start'>
                            <div class='icon-square bg-light text-dark flex-shrink-0 me-3'>
                                <span data-feather="{{ $report->icon }}"></span>
                            </div>
                            <div>
                                <h2>{{ $report->name }}</h2>
                                <p style="height: 70px; max-height: 70px; overflow: hidden; text-overflow: ellipsis;">{{ $report->description }}</p>
                                <a href='{{ route('admin.report.show', ['report' => $report->slug]) }}' class='btn btn-primary'>
                                    Построить
                                </a>
                            </div>
                        </div>

                    </div>

                @endforeach
            @else
                <h3>Отчётов нет</h3>
            @endif

        </div>

    </div>
@endsection
