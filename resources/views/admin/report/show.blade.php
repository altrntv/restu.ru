@extends('layouts.app')

@section('title', $report->organization->name . " :: " . $report->name)

@section('header')
    <!-- flatpickr -->
    <link href='{{ asset('/flatpickr/flatpickr.css') }}' rel='stylesheet' type='text/css' />
    <link href='{{ asset('/flatpickr/dropdowns.css') }}' rel='stylesheet' type='text/css' />

    <!-- WebDataRocks -->
    <link href='{{ asset('/webdatarocks/webdatarocks.min.css') }}' rel='stylesheet' type='text/css'/>
    <script src='{{ asset('/webdatarocks/webdatarocks.toolbar.min.js') }}' type='text/javascript'></script>
    <script src='{{ asset('/webdatarocks/webdatarocks.js') }}' type='text/javascript'></script>

    <!-- Styles select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('content')

        <div class="container px-4 py-5" id="hanging-icons">

            <a href="{{ url()->previous() }}">
                <span class="backspace">
                    <span data-feather="arrow-left"></span><span class="back-button">Назад</span>
                </span>
            </a>

            <div class="row">
                <h2 class="pb-2 border-bottom">
                    <span>{{ $report->organization->name . " :: " . $report->name }}</span>
                </h2>
            </div>

            <div class="row">
                <p>{{ $report->description }}</p>
            </div>

            <div class="col-6">
{{--                <form class="needs-validation" method="POST" action="/api/reports/5">--}}
{{--                    @csrf--}}
                @if($report->type_date === 'month')
                    <label for="date" class="form-label">Месяц</label>
                    <div class="input-group mb-3 flatpickr">
                        <input id="date" name="date" type="text" class="form-control flatpickr-input" placeholder="Выберите месяц" aria-label="Выберите месяц" aria-describedby="button-addon2" autocomplete="off" data-input>
                        <button id="submit" name="doReport" class="btn btn-primary" onclick="updateWDR()">Построить</button>
                    </div>
                @elseif($report->type_date === 'range')
                    <label for="date" class="form-label">Период</label>
                    <div class="input-group mb-3 flatpickr">
                        <input id="date" name="date" type="text" class="form-control flatpickr-input" placeholder="Выберите период" aria-label="Выберите период" aria-describedby="button-addon2" autocomplete="off" data-input>
                        <button id="button-addon2" name="doReport" class="btn btn-primary" onclick="updateWDR()">Построить</button>
                    </div>
                @elseif($report->type_date === 'day')
                    <label for="date" class="form-label">День</label>
                    <div class="input-group mb-3 flatpickr">
                        <input id="date" name="date" type="text" class="form-control flatpickr-input" placeholder="Выберите дату" aria-label="Выберите день" aria-describedby="button-addon2" autocomplete="off" data-input>
                        <button id="button-addon2" name="doReport" class="btn btn-primary" onclick="updateWDR()">Построить</button>
                    </div>
                @endif

                <label for="login" class="form-label">Логин</label>
                <div class="input-group mb-3">
                    <input id="login" name="login" type="text" class="form-control flatpickr-input" placeholder="Введите логин" aria-label="Введите логин" autocomplete="off" data-input>
                </div>

                <label for="pass" class="form-label">Пароль</label>
                <div class="input-group mb-3">
                    <input id="pass" name="pass" type="password" class="form-control flatpickr-input" placeholder="Введите пароль" aria-label="Введите пароль" autocomplete="off" data-input>
                </div>

                <button type="submit" class="btn btn-primary mb-3">Построить</button>

                <div class="input-group mb-3">
                    <button id="excel" class="btn btn-success" type="button" onclick="exportData('excel')" disabled>Экспорт в Excel</button>
                    <button id="fields" class="btn btn-outline-dark" type="button" onclick="fieldList()" disabled>Поля</button>
                    <button id="fullscreen" class="btn btn-outline-dark" type="button" onclick="fullscreen()" disabled>Полноэкранный</button>
                </div>

{{--                </form>--}}

                <form action="/api/admin/reports/{{ $report->id }}" method="POST">
                    @csrf

                    <input type="text" name="login" value="Beerdok">
                    <input type="text" name="password" value="1q2w3e4R">

                    <input type="submit" value="send">
                </form>

            </div>

            <div class="application-wdr">

                <section id="wdr">

                    <div class="wrap">

                        <div id="wdr-component" style="padding-bottom: 30px;"></div>

                    </div>

                </section>

                <div id="preloader">
                    <div id="svg-block" class="preload">
                        <svg width="150px" height="150px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 120 120" >

                            <path class="st0" d="M7.8,91h104.5c2.1,0,3.8-1.7,3.8-3.8V52.1V12L77,42H36L23,70L4,79.2v8.1C4,89.3,5.7,91,7.8,91z">
                                <animate attributeName="d" dur="1.4s" repeatCount="indefinite" values="
                        M7.8,91h104.5c2.1,0,3.8-1.7,3.8-3.8V52.1V12L77,42H36L23,70L4,79.2v8.1C4,89.3,5.7,91,7.8,91z;
                        M7.8,91h104.5c2.1,0,3.8-1.7,3.8-3.8V52.1V20L70,60H34L27,72L4,76.2v8.1C4,89.3,5.7,91,7.8,91z;
                        M7.8,91h104.5c2.1,0,3.8-1.7,3.8-3.8V52.1V12L77,42H36L23,70L4,79.2v8.1C4,89.3,5.7,91,7.8,91z" />
                            </path>

                            <path class="st1" d="M112.2,91H7.8C5.7,91,4,89.3,4,87.2v-5l21.4-7.5l28-21l18.4,2.3l27.8-20.3L116,52.1v35.1 C116,89.3,114.3,91,112.2,91z">
                                <animate attributeName="d" dur="1.4s" repeatCount="indefinite" values="
                        M112.2,91H7.8C5.7,91,4,89.3,4,87.2v-5l21.4-7.5l28-21l18.4,2.3l27.8-20.3L116,52.1v35.1C116,89.3,114.3,91,112.2,91z;
                        M112.2,91H7.8C5.7,91,4,89.3,4,87.2v-5l20.4-7.5l29-1l18.4-27.7l27.8,19.7L116,52.1v35.1C116,89.3,114.3,91,112.2,91z;
                        M112.2,91H7.8C5.7,91,4,89.3,4,87.2v-5l21.4-7.5l28-21l18.4,2.3l27.8-20.3L116,52.1v35.1C116,89.3,114.3,91,112.2,91z"/>
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

        </div>


@endsection

@section('footer')

    <script>
        let pivot = new WebDataRocks({
            container: "#wdr-component",
            toolbar: false,
            global: {
                localization: "{!! asset('/webdatarocks/loc/ru.json') !!}"
            },
        })

        let svgBlock = document.getElementById("svg-block")

        function updateWDR() {
            let date = document.getElementById("date").value
            if(date) {
                svgBlock.classList.add("active");
                console.log(pivot)
                axios.post('/api/admin/reports/{!! $report->id !!}', { date: date, type: '{!! $report->type_date !!}' })
                    .then(res => {
                        pivot.setReport({
                            dataSource: {
                                data: res.data.request.data
                            },
                            options: res.data.settings.options,
                            slice: res.data.settings.slice,
                            formats: res.data.settings.formats,
                            conditions: res.data.settings.conditions
                        })
                        svgBlock.classList.remove("active");
                        document.querySelector('#excel').disabled = false;
                        document.querySelector('#fields').disabled = false;
                    })
            } else {
                alert('Введите дату')
            }

        }

        function exportData(type) {
            pivot.exportTo(type);
        }

        function fieldList() {
            pivot.openFieldsList();
        }

        function fullscreen() {

        }
    </script>

@endsection
