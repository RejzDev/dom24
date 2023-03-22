@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">

@endsection

@section('title')
    Лицевые счета
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

                        <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                            Выберите действие
                        </button>
                        <div class="dropdown-menu butt_exel" >
                            <a class="dropdown-item" href="{{route('adminApartamentsCreate')}}">Добавить квартиру</a>

                        </div>

            </div>
            </div>

            <div class="col-xl-12">

                <div class="card">

                    <div class="card-header with-border">
                        <h3 class="card-title"></h3>
                        <div class="card-tools">
                            <a href="{{route('personalAccount.index')}}" class="btn btn-default btn-sm">Очистить</a>
                        </div>
                    </div>
                <div class="card-body">


                    <table id="apartment" class="table table-striped table-bordered table-hover dataTable dtr-inline" style="width:100%">


                        <thead>

                        <tr>
                            <th style="max-width: 120px; width: 70px; min-width: 60px"><small>№</small></th>
                            <th><small> Статус</small></th>
                            <th style="max-width: 150px; width: 70px; min-width: 40px"><small>Квартира</small></th>
                            <th><small>Дом</small></th>
                            <th><small>Секция</small></th>
                            <th><small>Владелец</small></th>
                            <th><small>Остаток (грн)</small></th>
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
                        </tr>

                        </thead>

                        <tbody>







                        @foreach($accounts as $key =>$account)

                            <tr onclick="window.location.href='{{route('personalAccount.show', $account['id'])}}'" style="cursor:pointer">
                                <td class="small">{{$account->number}}</td>
                                <td class="small">@if($account->status == 1) <small class="btn-success btn-xs">Активен</small> @else  <small class="btn-danger btn-xs">Неактивен</small> @endif</td>
                                <td class="small">@if(empty($account->apartaments)) (не задано) @else {{$account->apartaments['number']}}  @endif</td>
                                <td class="small">@if(empty($account->apartaments->houses)) (не задано) @else {{$account->apartaments->houses['house_name']}} @endif</td>
                                <td class="small">@if(empty($account->apartaments->sections)) (не задано) @else {{$account->apartaments->sections['name']}} @endif</small></td>
                                <td class="small">@if(empty($account->apartaments->users)) (не задано) @else  {{$account->apartaments->users['lastname']}}  {{$account->apartaments->users['firstname']}} {{$account->apartaments->users['middlename']}} @endif</td>
                                <td class="small @if($account->getBalance() < 0)text-red @else text-green @endif ">{{$account->getBalance()}}</td>
                                <td><a class="btn btn-info btn-xs " href="{{route('personalAccount.edit', $account->id)}}"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger btn-xs" href="{{route('PersonalAccountRemove', $account->id)}}"><i class="fas fa-trash"></i></a>
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
            <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
            <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
            <script src="{{asset('plugins/select2/js/i18n/ru.js')}}"></script>

            <script>




                $(document).ready(function() {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
                    var table = $('#apartment').DataTable({
                        "language": {
                            "url": '{{asset('plugins/datatables/datatables_ru.json')}}',
                        },
                        "sDom": '<"top"i>rt<"label"lp><"clear">',
                        "orderCellsTop": true,
                        "fixedHeader": true,
                        "lengthChange": false,
                        "columns": [
                            {
                                "orderable": false,
                                "targets":  0

                            },
                            {
                                "orderable": false,
                                "targets":  1

                            },
                            {
                                "orderable": false,
                                "targets":  2

                            },
                            {
                                "orderable": false,
                                "targets":  3

                            },
                            {
                                "orderable": false,
                                "targets":  4

                            },
                            {
                                "orderable": false,
                                "targets":  5

                            },
                            {
                                "orderable": false,
                                "targets":  6

                            },
                            {

                                "orderable": false,
                                "searchable": false,
                                "targets": 7

                            }],


                        initComplete: function () {
                            $("#apartment").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");


                            this.api().columns([1]).every( function () {
                                var column = this;
                                var select = $('<select class="form-control filter_house">' +
                                    '<option value=""></option>' +
                                    '</select>')
                                    .appendTo(  $('thead tr:eq(1) th:eq(' + this.index()  + ')') )
                                    .on( 'change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()

                                        );

                                        column
                                            .search( val ? '^'+val+'$' : " ", true, false )
                                            .draw();
                                    } );

                                select.append( '<option value="Активен">Активен</option>' )
                                select.append( '<option value="Неактивен">Неактивен</option>' )

                            } );

                            this.api().columns([3]).every( function () {
                                var column = this;

                                var select = $('<select id="house_filter" class="form-control filter_house">' +
                                    '<option value=""></option>' +
                                    @foreach($houses as $key => $house)
                                        '<option value="{{$house['id']}}">{{$house['house_name']}}</option>' +
                                    @endforeach
                                    '</select>')
                                    .appendTo(  $('thead tr:eq(1) th:eq(' + this.index()  + ')') )
                                    .on( 'change', function () {
                                        var val = $('#house_filter option:selected').text();


                                        column
                                            .search( val ? '^'+val+'$' : " ", true, false )
                                            .draw();

                                        $('#section_id option').remove();
                                        $('#section_id').append('<option value="">Выберите...</option>');
                                        $.ajax({
                                            url: '/admin-panel/get-house-id/' + $('#house_filter option:selected').val(),
                                            type: "GET",
                                            headers: {
                                                'X-CSRF-Token': '{{csrf_token()}}'
                                            },
                                            dataType: 'json',
                                            success: function (json) {

                                                json['sections'].forEach(function (section, key) {

                                                    $('#section_id').append('<option value="' + section["name"] + '"> ' + section["name"] + '</option>');

                                                })

                                            }
                                        });
                                    } );


                            } );



                                this.api().columns([4]).every(function () {
                                    var column = this;
                                    var select = $('<select id="section_id" class="form-control filter">' +
                                        '<option value=""></option>' +
                                        '</select>')
                                        .appendTo($('thead tr:eq(1) th:eq(' + this.index() + ')'))
                                        .on('change', function () {
                                            var val = $('#section_id option:selected').val();


                                            column
                                                .search(val ? '^' + val + '$' : " ", true, false)
                                                .draw();

                                            console.log(val);

                                        });


                                });
                            this.api().columns([5]).every( function () {
                                var column = this;
                                var select = $('<select id="user_filter" class="form-control"><option value=""></option></select>')
                                    .appendTo(  $('thead tr:eq(1) th:eq(' + this.index()  + ')') )
                                    .on( 'change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );


                                            column
                                                .search( val ? '^'+val+'$' : " ", true, false )
                                                .draw();


                                    } );


                                column.data().unique().sort().each( function ( d, j ) {
                                    select.append( '<option value="'+d.replace(/"/g, '&#34;')+'">'+d+'</option>' )
                                } );

                            } );
                            this.api().columns([6]).every( function () {
                                var column = this;
                                console.log(this.index())
                                var select = $('<select class="form-control filter_house"><option value=""></option></select>')
                                    .appendTo(  $('thead tr:eq(1) th:eq(' + this.index()  + ')') )
                                    .on( 'change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()

                                        );

                                        if(val == 0){

                                            column.search('^[0-9]+', true, false).draw();
                                        }
                                        if(val == 1){
                                            column.search('-' ? '-' : '', false, false).draw();
                                        }
                                    } );

                                select.append( '<option value="1">Есть долг</option>' )
                                select.append( '<option value="0">Нет долга</option>' )

                            } );

                            this.api().columns([0,2]).every( function () {
                                var that = this;

                                $( '<input type="text" placeholder="" class="form-control" >')
                                    .appendTo(  $('thead tr:eq(1) th:eq(' + this.index()  + ')') )
                                    .on( 'keyup change clear', function () {
                                    if ( that.search() !== this.value ) {
                                        that
                                            .search( this.value )
                                            .draw();
                                    }
                                } );
                            } );

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

                    new $.fn.dataTable.Buttons( table, {
                        buttons: [
                            {extend: 'excel', text: 'Выгрузить в Excel'}


                        ]
                    } );

                    table.buttons().container()
                        .appendTo( $('.butt_exel', table.table().container() ) );

                } );


                //cdn.datatables.net/plug-ins/1.11.4/i18n/uk.json
            </script>


@endsection
