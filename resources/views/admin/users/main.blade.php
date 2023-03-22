@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">

@endsection

@section('title')
    Владельцы квартир
@endsection




@section('content')



    <div class="content">
        @if (Session::has('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
            </div>
        @endif


        <div class="row">

            <div class="card-body">
                <div class="float-right">
                    <a class="btn btn-success pull-right" href="{{route('userCreate')}}">Добавить владельца</a>
                </div>
            </div>

            <div class="col-xl-12">

                <div class="card">

                    <div class="card-header with-border">
                        <h3 class="card-title"></h3>
                        <div class="card-tools">
                            <a href="{{route('userIndex')}}" class="btn btn-default btn-sm">Очистить</a>
                        </div>
                    </div>

                    <div class="card-body">


                        <table id="user"
                               class="table table-striped table-bordered table-hover dataTable dtr-inline"
                               style="width:100%">


                            <thead>

                            <tr>
                                <th style="max-width: 70px; width: 60px; min-width: 50px"><small>ID</small></th>
                                <th style="min-width: 200px"><small> ФИО</small></th>
                                <th style="width: 140px; min-width: 140px"><small>Телефон</small></th>
                                <th style="width: 140px; min-width: 140px"><small>Email</small></th>
                                <th style="min-width: 200px"><small>Дом</small></th>
                                <th style="min-width: 200px"><small>Квартира</small></th>
                                <th style="width: 110px; min-width: 110px"><small>Добавлен</small></th>
                                <th style="width: 80px; min-width: 80px"><small>Статус</small></th>
                                <th style="width: 80px; min-width: 80px"><small>Долг</small></th>
                                <th style=" min-width: 50px"></th>

                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>

                            </thead>

                            <tbody>


                            @foreach($users as $user)

                                <tr onclick="window.location.href='{{route('userShow', $user['id'])}}'" style="cursor:pointer">
                                    <td class="small">{{$user->userid}}</td>
                                    <td class="small">@if(empty($user->lastname) && empty($user->firstname) && empty($user->middlename))
                                            (не задано) @else
                                            {{$user->lastname}} {{$user->firstname}} {{$user->middlename}} @endif
                                    </td>
                                    <td class="small"> {{$user->phone}}</td>
                                    <td class="small">{{$user->email}}</td>
                                    <td class="small">@if(!empty($user->house))
                                            @foreach($user->house as $house)
                                                 <a href="{{route('adminHouseShow', $house->id)}}" >{{$house->house_name}}</a><br>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="small">
                                        @if(!empty($user->apartaments))
                                            @foreach($user->apartaments as $apartment)
                                              <a href="{{route('adminApartamentsShow', $apartment->id)}}">{{$apartment->number}}</a>,<br>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="small">
                                       {{\Carbon\Carbon::parse($user->created_at)->format('d.m.Y')}}
                                    </td>
                                    <td class="small">
                                        @if($user->status == 1)
                                            <small class="btn-success btn-xs">Активен</small>
                                        @elseif($user->status == 2)
                                            <small class="btn-warning btn-xs">Новый</small>
                                        @else
                                            <small class="btn-danger btn-xs">Отключен</small>
                                        @endif
                                    </td>
                                    <td class="small">
                                        да
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-xs"
                                           href="{{route('userEdit', $user->id)}}"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <a class="btn btn-danger btn-xs"
                                           href="{{route('userRemove', $user->id)}}"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('js')

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/select2/js/i18n/ru.js')}}"></script>

    <script>

        $(document).ready(function () {


            var table = $('#user').DataTable({

                "language": {
                    "url": '{{asset('plugins/datatables/datatables_ru.json')}}',
                },
                "orderCellsTop": true,
                "lengthChange": false,
                "sDom": '<"top"i>rt<"bottom"lp><"clear">',
                "columns": [
                    {
                        "orderable": false,
                        "targets": 0
                    },
                    null,
                    {
                        "orderable": false,
                        "targets": 2
                    },
                    {
                        "orderable": false,
                        "targets": 3
                    },
                    {
                        "orderable": false,
                        "targets": 4
                    },
                    {
                        "orderable": false,
                        "targets": 5
                    },
                    null,
                    {
                        "orderable": false,
                        "targets": 7
                    },
                    {
                        "orderable": false,
                        "targets": 8
                    },
                    {

                        "orderable": false,
                        "searchable": false,
                        "targets": 9

                    }],

                "order": [[6, 'desc']],

                initComplete: function () {
                    $("#user").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
                    this.api().columns([4]).every(function () {
                        var column = this;
                        console.log(this.index())
                        var select = $('<select class="form-control filter_house"><option value=""></option></select>')
                            .appendTo($('thead tr:eq(1) th:eq(' + this.index() + ')'))
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                if (column.search() !== val) {
                                    column
                                        .search(val)
                                        .draw();
                                }
                            });

                        @foreach($houses as $house)
                        select.append('<option value="{{$house->house_name}}">{{$house->house_name}}</option>')
                        @endforeach
                    });

                    this.api().columns([8]).every(function () {
                        var column = this;
                        console.log(this.index())
                        var select = $('<select class="form-control filter_house"><option value=""></option></select>')
                            .appendTo($('thead tr:eq(1) th:eq(' + this.index() + ')'))
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : " ", true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d.replace(/"/g, '&#34;') + '"><small>' + d + '</small></option>')
                        });

                    });

                    this.api().columns([7]).every(function () {
                        var column = this;
                        console.log(this.index())
                        var select = $('<select class="form-control filter_house"><option value=""></option></select>')
                            .appendTo($('thead tr:eq(1) th:eq(' + this.index() + ')'))
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );


                                column
                                    .search(val ? '^' + val + '$' : " ", true, false)
                                    .draw();

                            });

                        select.append('<option value="Активен"><small>Активен</small></option>')
                        select.append('<option value="Новый"><small>Новый</small></option>')
                        select.append('<option value="Отключен"><small>Отключен</small></option>')

                    });
                    this.api().columns([0, 1, 2, 3, 5, 6]).every(function () {
                        var that = this;

                        $('<input type="text" placeholder="" class="form-control" >')
                            .appendTo($('thead tr:eq(1) th:eq(' + this.index() + ')'))
                            .on('keyup change clear', function () {
                                if (that.search() !== this.value) {
                                    that
                                        .search(this.value)
                                        .draw();
                                }
                            });
                    });

                    $("#user_filter").select2({
                        placeholder: " ",
                        language: "ru"

                    });
                    $(".filter_house").select2({
                        placeholder: " ",
                        language: "ru",
                        minimumResultsForSearch: -1

                    });


                }

            });



        });


        //cdn.datatables.net/plug-ins/1.11.4/i18n/uk.json
    </script>


@endsection
