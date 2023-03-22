@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">

@endsection

@section('title')
    Касса
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

                <div class="row">

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$data['cashBox']}} грн.</h3>

                                <p>Состояние кассы</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-cash"></i>
                            </div>
                               </div>
                    </div>


                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$data['total']}} грн.</h3>

                                <p>Баланс по счетам</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-cash"></i>
                            </div>
                              </div>
                    </div>
                    <!-- ./col -->


                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{-$data['debt']}} грн.</h3>

                                <p>Задолженность по счетам</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-cash"></i>
                            </div>
                             </div>
                    </div>
                    <!-- ./col -->


                    <div class="col-lg-3 col-6">
                        <div class="float-right">

                            <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown"
                                    aria-expanded="false">
                                Выберите действие
                            </button>
                            <div class="dropdown-menu butt_exel">
                                <a class="dropdown-item" href="{{route('admin.invoice.create')}}">Добавить общую квитанцию</a>
                                <a href="#!" class="dropdown-item delete-many">Удалить</a>
                            </div>

                        </div>
                    </div>
                </div>


            </div>

            <div class="col-xl-12">

                <div class="card">

                    <div class="card-header with-border">
                        <h3 class="card-title"></h3>
                        <div class="card-tools">
                            <a href="{{route('admin.invoice.index')}}" class="btn btn-default btn-sm">Очистить</a>
                        </div>
                    </div>
                    <div class="card-body">


                        <table id="apartment"
                               class="table table-striped table-bordered table-hover dataTable dtr-inline"
                               style="width:100%">


                            <thead>

                            <tr>

                                <th style="max-width: 40px; width: 40px; min-width: 20px"><small>№</small>
                                </th>
                                <th style="max-width: 150px; width: 70px; min-width: 40px"><small>Дата</small></th>
                                <th><small> Статус</small></th>
                                <th><small>Тип платежа</small></th>
                                <th><small>Владелец</small></th>
                                <th><small>Лицевой счет	</small></th>
                                <th><small>Приход/расход	</small></th>
                                <th><small>Сумма (грн)</small></th>
                                <th style="max-width: 100px; width: 50px; min-width: 40px"></th>

                            </tr>
                            <tr>

                                <th></th>
                                <th><input type="text" placeholder="" name="reportrange" id="reportrange"  class="form-control" ></th>
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


                            <form action="">


                                @foreach($accountTransaction as $key =>$transaction)

                                    <tr style="cursor:pointer">
                                        <td class="small">@if(isset($transaction->uid))
                                                <a href="{{route('admin.account-transaction.show', $transaction->id)}}">{{$transaction->uid}} </a>
                                            @endif</td>
                                        <td class="small">@if(isset($transaction->uid_date))
                                                {{date('d.m.Y', strtotime($transaction->uid_date))}}
                                            @endif</td>
                                        <td class="small">@if($transaction->status == 10)
                                                Проведен
                                            @else
                                                Не проведен
                                            @endif</td>
                                        <td class="small">@if(empty($transaction->transactionPurpose['name']))
                                                (не задано)
                                            @else
                                                {{$transaction->transactionPurpose['name']}}
                                            @endif</td>
                                        <td class="small">@if(empty($transaction->account->apartaments->users['firstname']))
                                                (не задано)
                                            @else
                                                {{$transaction->account->apartaments->users['firstname']}}
                                            @endif</td>
                                        <td class="small">@if(empty($transaction->account['number']))
                                                (не задано)
                                            @else
                                                {{$transaction->account['number']}}
                                            @endif</td>
                                        <td class="small @if($transaction['type'] == 'out' ) text-red @else text-green @endif">
                                            @if($transaction['type'] == 'out' )Расход @else Приход @endif
                                        </td>
                                        <td class="small @if($transaction['type'] == 'out' ) text-red @else text-green @endif">
                                            @if($transaction['type'] == 'out' ) - @endif{{$transaction['amount']}}
                                        </td>

                                        <td>
                                                  <a class="btn btn-defaultbtn-xs "
                                               href="{{route('admin.account-transaction.edit', $transaction->id)}}"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <a class="btn btn-default btn-xs"
                                               href="{{route('admin.invoiceRemove', $transaction->id)}}"><i
                                                    class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>

                                @endforeach
                            </form>
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
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/select2/js/i18n/ru.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{asset('plugins/bootstrap-datepicker/ru.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/locale/ru.js"></script>

    <script>


        $(document).ready(function () {


            $(function() {


                var start = moment("2022-08-21");
                var end = moment("2022-08-21");

                function cb(start, end) {
                    $('#reportrange span').html(start.format('DD, MM, YYYY') + ' - ' + end.format('DD, MM, YYYY'));
                }


                $('#reportrange').daterangepicker({
                    language: 'ru',
                    autoUpdateInput: false,
                    startDate: start,
                    endDate: end,
                    locale: {
                        "moment.locale": 'ru',
                        "applyLabel": "Принять",
                        "cancelLabel": "Закрить",
                        "fromLabel": "From",
                        "toLabel": "To",
                        "firstDay": 1},

                    "opens": "right",
                }, cb);

                cb(start, end);

            });

            $('input[name="reportrange"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });


            $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                var start = picker.startDate.format('DD.MM.YYYY');
                var end = picker.endDate.format('DD.MM.YYYY');


                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var min = start;

                        var max = end;
                        var startDate = data[1];
                        console.log(startDate);
                        if (min == null && max == null) {
                            return true;
                        }
                        if (min == null && startDate <= max) {
                            return true;
                        }
                        if (max == null && startDate >= min) {
                            return true;
                        }
                        if (startDate <= max && startDate >= min) {
                            return true;
                        }
                        return false;
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });




            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')


            $("#checkAll").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });




            var table = $('#apartment').DataTable({
                "language": {
                    "url": '{{asset('plugins/datatables/datatables_ru.json')}}',
                },
                "sDom": '<"top"i>rt<"label"lp><"clear">',
                "orderCellsTop": true,
                "fixedHeader": true,
                "lengthChange": false,
                'columnDefs': [
                    {
                        'orderable': false,
                        'targets': 0,

                    },
                    {
                        type: 'extract-date',
                        targets: [1]
                    },
                    {
                        'orderable': false,
                        'targets': [ 2, 3, 4, 5, 6, 7, 8],

                    }
                ],

                'order': [[1, 'desc']],

                initComplete: function () {
                    $("#apartment").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");


                    this.api().columns([2]).every(function () {
                        var column = this;
                        var select = $('<select class="form-control filter_house">' +
                            '<option value=""></option>' +
                            '</select>')
                            .appendTo($('thead tr:eq(1) th:eq(' + this.index() + ')'))
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : " ", true, false)
                                    .draw();
                            });

                        select.append('<option value="Проведен">Проведен</option>')
                        select.append('<option value="Не проведен">Не проведен</option>')


                    });


                    this.api().columns([6]).every(function () {
                        var column = this;
                        var select = $('<select id="user_filter" class="form-control"><option value=""></option></select>')
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
                            select.append('<option value="' + d.replace(/"/g, '&#34;') + '">' + d + '</option>')
                        });

                    });

                    this.api().columns([3]).every(function () {
                        var column = this;
                        var select = $('<select class="form-control filter_house">' +
                            '<option value=""></option>' +
                            @foreach($purpose as $item)
                            '<option value="{{$item->name}}">{{$item->name}}</option>' +
                            @endforeach
                            '</select>')
                            .appendTo($('thead tr:eq(1) th:eq(' + this.index() + ')'))
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : " ", true, false)
                                    .draw();
                            });



                    });

                    this.api().columns([0,  4, 5]).every(function () {
                        var that = this;

                        $('<input type="text" placeholder=""  class="form-control" >')
                            .appendTo($('thead tr:eq(1) th:eq(' + this.index() + ')'))
                            .on('keyup change clear', function () {
                                if (that.search() !== this.value) {
                                    that
                                        .search(this.value)
                                        .draw();
                                }
                            });
                    });



                    $(".filter").select2({
                        placeholder: "Выберите дом",
                        language: "ru",
                        minimumResultsForSearch: -1

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





    </script>

@endsection
