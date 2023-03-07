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
                @else
                    <label for="date" class="form-label">День</label>
                    <div class="input-group mb-3 flatpickr">
                        <input id="date" name="date" type="text" class="form-control flatpickr-input" placeholder="Выберите дату" aria-label="Выберите день" aria-describedby="button-addon2" autocomplete="off" data-input>
                        <button id="button-addon2" name="doReport" class="btn btn-primary" onclick="updateWDR()">Построить</button>
                    </div>
                @endif

{{--                <label for="storage" class="form-label">Склад</label>--}}
{{--                <div class="input-group mb-3">--}}
{{--                    <select class="form-select" id="storage">--}}
{{--                        <option value="Склад_ДСО (Солнечная поляна)" selected>Склад_ДСО (Солнечная поляна)</option>--}}
{{--                        <option value="Склад_ДСО2 (Власихинская)">Склад_ДСО2 (Власихинская)</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <label for="dish" class="form-label">Блюдо</label>--}}
{{--                <div class="input-group mb-3">--}}
{{--                    <select class="form-select" id="dish">--}}
{{--                        <option>Reactive</option>--}}
{{--                        <option>Solution</option>--}}
{{--                        <option>Conglomeration</option>--}}
{{--                        <option>Algoritm</option>--}}
{{--                        <option>Holistic</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

                <div class="input-group mb-3">
                    <button id="excel" class="btn btn-success" type="button" onclick="exportData('excel')" disabled>Экспорт в Excel</button>
                    <button id="fields" class="btn btn-outline-dark" type="button" onclick="fieldList()" disabled>Поля</button>
                    <button id="fullscreen" class="btn btn-outline-dark" type="button" onclick="openFullscreen()" disabled>Полноэкранный</button>
                </div>

{{--                <form action="/api/reports/{{ $report->id }}" method="POST">--}}
{{--                    @csrf--}}

{{--                    <input type="text" name="date" value="11.2022">--}}
{{--                    <input type="text" name="type" value="month">--}}

{{--                    <input type="submit" value="send">--}}
{{--                </form>--}}

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
    <!-- Scripts select2 -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(".form-select").select2({
            theme: "bootstrap-5",
            selectionCssClass: "select2--normal",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script src="{{ asset('/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('/flatpickr/monthSelectPlugin.js') }}"></script>

    @if($report->type_date === 'month')

        <script>
            flatpickr(".flatpickr input",
                {
                    plugins: [
                        new monthSelectPlugin({
                            shorthand: true, //defaults to false
                            dateFormat: "m.Y", //defaults to "F Y"
                        })
                    ]
                });

        </script>

    @elseif($report->type_date === 'range')

        <script>
            flatpickr(".flatpickr input",
                {
                    "dateFormat": "d.m.Y",
                    "locale": {
                        "firstDayOfWeek": 1 // start week on Monday
                    },
                    "mode": "range"
                });
        </script>

    @else

        <script>
            flatpickr(".flatpickr",
                {
                    "dateFormat": "d.m.Y",
                    "locale": {
                        "firstDayOfWeek": 1 // start week on Monday
                    },
                    "wrap": true,
                });
        </script>

    @endif

    <script>
        let reportId = {!! $report->id !!};

        let pivot = new WebDataRocks({
            container: "#wdr-component",
            toolbar: false,
            global: {
                localization: "{!! asset('/webdatarocks/loc/ru.json') !!}"
            },
            customizeCell: customizeCellFunction
        })

        let svgBlock = document.getElementById("svg-block")

        function updateWDR() {
            let date = document.getElementById("date").value
            if(date) {
                svgBlock.classList.add("active");

                axios.post('/api/reports/{!! $report->id !!}', { date: date, type: '{!! $report->type_date !!}' })
                    .then(res => {
                        console.log(res)
                        pivot.setReport({
                            dataSource: {
                                data: res.data.request
                            },
                            options: res.data.settings.options,
                            slice: res.data.settings.slice,
                            formats: res.data.settings.formats,
                            conditions: res.data.settings.conditions
                        })
                        svgBlock.classList.remove("active");
                        document.querySelector('#excel').disabled = false;
                        document.querySelector('#fields').disabled = false;
                        document.querySelector('#fullscreen').disabled = false;
                    })
            } else {
                alert('Введите дату')
            }
        }

        function customizeCellFunction(cellBuilder, cellData) {
            //let dayOfWeek;
            if(reportId === 6)
            {
                if (cellData && cellData.type === "value" && cellData.measure && cellData.measure.uniqueName === "Delivery.CookingFinishTime" && cellBuilder.text)
                {
                    const [day, month, year, time] = cellBuilder.text.split(/[. :]/);
                    const date = new Date(year, month - 1, day);

                    const daysOfWeek = ['вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'];
                    dayOfWeek = daysOfWeek[date.getDay()];
                }
                if (cellData && cellData.type === "value" && cellData.measure && cellData.measure.uniqueName === "Delivery.TimePreparationDelivery" )
                {
                    if(dayOfWeek === 'сб' || dayOfWeek === 'вс')
                    {
                        if (cellData.value > 60) {
                            cellBuilder.style['background-color'] = "#f53b57";
                        } else if (cellData.value <= 60) {
                            cellBuilder.style['background-color'] = "#05c46b";
                        }
                    }
                }
            }
        }

        function exportData(type) {
            pivot.exportTo(type);
        }

        function fieldList() {
            pivot.openFieldsList();
        }

        function openFullscreen() {
            var elem = document.getElementById("wdr-component");
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) { /* Firefox */
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE/Edge */
                elem.msRequestFullscreen();
            }
        }

        function exitFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { /* Firefox */
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE/Edge */
                document.msExitFullscreen();
            }
        }
    </script>

@endsection
