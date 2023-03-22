@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">

@endsection

@section('title')
    Квитанции на оплату
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
                                <th><small><input type="checkbox" id="checkAll"></small></th>
                                <th style="max-width: 120px; width: 70px; min-width: 60px"><small>№ квитанции</small>
                                </th>
                                <th><small> Статус</small></th>
                                <th style="max-width: 150px; width: 70px; min-width: 40px"><small>Дата</small></th>
                                <th><small>Месяц</small></th>
                                <th><small>Квартира</small></th>
                                <th><small>Владелец</small></th>
                                <th><small>Проведена</small></th>
                                <th><small>Сумма (грн)</small></th>
                                <th style="max-width: 100px; width: 50px; min-width: 40px"></th>

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


                            <form action="">


                                @foreach($invoices as $key =>$invoice)

                                    <tr style="cursor:pointer">
                                        <td class="small">
                                            <input type="checkbox" name="selection[]" value="{{$invoice->id}}">
                                        </td>
                                        <td class="small">@if(isset($invoice->uid))
                                                <a href="{{route('admin.invoice.show', $invoice['id'])}}">{{$invoice->uid}} </a>
                                            @endif</td>
                                        <td class="small">@if($invoice->status == 10)
                                                <small class="btn-success btn-xs">Оплачена</small>
                                            @elseif($invoice->status == 5)
                                                <small class="btn-warning text-light btn-xs">Частично оплачена</small>
                                            @else
                                                <small class="btn-danger btn-xs">Неоплачена</small>
                                            @endif</td>
                                        <td class="small">@if(isset($invoice->uid_date))
                                                {{$invoice->uid_date}}
                                            @endif</td>
                                        <td class="small">@if(isset($invoice->dateMonth))
                                                {{$invoice->dateMonth}}
                                            @endif</td>
                                        <td class="small">@if(empty($invoice->apartaments))
                                                (не задано)
                                            @else
                                                {{$invoice->apartaments['number']}}
                                            @endif</td>
                                        <td class="small">@if(empty($invoice->apartaments->users))
                                                (не задано)
                                            @else
                                                {{$invoice->apartaments->users['lastname']}}  {{$invoice->apartaments->users['firstname']}} {{$invoice->apartaments->users['middlename']}}
                                            @endif</td>
                                        <td class="small">@if($invoice->is_checked == 1)
                                                Проведена
                                            @else
                                                Не проведена
                                            @endif</td>
                                        <td class="small">@if(isset($invoice->priceTotal))
                                                {{$invoice->priceTotal}}
                                            @endif</td>

                                        <td>
                                            <a class="btn btn-default btn-xs "
                                               href="{{route('admin.createInvoiceClone', $invoice->id)}}"><i
                                                    class="fas fa-clone"></i></a>
                                            <a class="btn btn-defaultbtn-xs "
                                               href="{{route('admin.invoice.edit', $invoice->id)}}"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <a class="btn btn-default btn-xs"
                                               href="{{route('admin.invoiceRemove', $invoice->id)}}"><i
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


    <script>


        $(document).ready(function () {


            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')


            $("#checkAll").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });


            // Delete button trigger
            $('body').on('click', '.delete-many', function () {
                var ids = [];
                $('input[name="selection[]"]:checked').each(function () {
                    var v = $(this).val();
                    ids.push(v);
                });
                if (ids.length) {
                    $.ajax({
                        url: '/admin/invoice/ajax-delete',
                        headers: {
                            'X-CSRF-Token': '{{csrf_token()}}'
                        },
                        data: {ids: ids},
                        type: 'post',
                        success: function (data) {
                            location.reload();
                        },

                    });

                }
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
                        'orderable': false,
                        'targets': [1, 2, 5, 6, 7, 8, 9],

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

                        select.append('<option value="Оплачена">Оплачена</option>')
                        select.append('<option value="Частично оплачена">Частично оплачена</option>')
                        select.append('<option value="Неоплачена">Неоплачена</option>')

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

                    this.api().columns([7]).every(function () {
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

                        select.append('<option value="Проведена">Проведена</option>')
                        select.append('<option value="Не проведена">Не проведена</option>')

                    });

                    this.api().columns([1, 3, 4, 5]).every(function () {
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
                    var btns = $('.dt-button');
                    btns.addClass('dropdown-item');
                    btns.removeClass('dt-button');
                }


            });


        });




        //cdn.datatables.net/plug-ins/1.11.4/i18n/uk.json
    </script>

@endsection
