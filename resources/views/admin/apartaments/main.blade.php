@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">

@endsection

@section('title')
    Квартиры
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
                <a class="btn btn-success pull-right" href="{{route('adminApartamentsCreate')}}">Добавить квартиру</a>
            </div>
            </div>

            <div class="col-xl-12">

                <div class="card">

                    <div class="card-header with-border">
                        <h3 class="card-title"></h3>
                        <div class="card-tools">
                            <a href="{{route('adminApartamentsIndex')}}" class="btn btn-default btn-sm">Очистить</a>
                        </div>
                    </div>
                <div class="card-body">


                    <table id="apartment" class="table table-striped table-bordered table-hover dataTable dtr-inline" style="width:100%">


                        <thead>

                        <tr>
                            <th style="max-width: 120px; width: 70px; min-width: 60px"><small>№ квартиры</small></th>
                            <th><small> Дом</small></th>
                            <th style="max-width: 150px; width: 70px; min-width: 40px"><small>Секция</small></th>
                            <th><small>Этаж</small></th>
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
                        </tr>

                        </thead>

                        <tbody>







                        @foreach($apartments as $key =>$apartment)

                            <tr onclick="window.location.href='{{route('adminApartamentsShow', $apartment['id'])}}'" style="cursor:pointer">
                                <td class="small">{{$apartment->number}}</td>
                                <td class="small">{{$apartment->houses->house_name}}</td>
                                <td class="small">{{$apartment->sections->name}}</td>
                                <td class="small">@if(empty($apartment->flours)) (не задано) @else {{$apartment->flours->name}} @endif</td>
                                <td class="small">{{$apartment->users->lastname}} {{$apartment->users->firstname}} {{$apartment->users->middlename}}</small></td>
                                <td class="small">@if($key==1) -1 @else {{$key}}  @endif</td>
                                <td><a class="btn btn-info btn-xs " href="{{route('adminApartamentsEdit', $apartment->id)}}"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger btn-xs" href="{{route('adminApartamentsRemove', $apartment->id)}}"><i class="fas fa-trash"></i></a>
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
            <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
            <script src="{{asset('plugins/select2/js/i18n/ru.js')}}"></script>

            <script>

                $(document).ready(function() {
                    var table = $('#apartment').DataTable({
                        "language": {
                            "url": '{{asset('plugins/datatables/datatables_ru.json')}}',
                        },


                        "orderCellsTop": true,
                        "fixedHeader": true,
                        "lengthChange": false,
                        "sDom": '<"top"i>rt<"bottom"lp><"clear">',
                        "columns": [
                            null,
                            null,
                            null,
                            null,
                            null,
                            {
                                "orderable": false,
                                "targets":  5

                            },
                            {

                                "orderable": false,
                                "searchable": false,
                                "targets":  6

                            }],

                        "order": [[ 1, 'desc' ]],

                        initComplete: function () {
                            $("#apartment").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
                            this.api().columns([1]).every( function () {
                                var column = this;
                                console.log(this.index())
                                var select = $('<select id="house_filter" class="form-control filter_house"><option value=""></option></select>')
                                    .appendTo(  $('thead tr:eq(1) th:eq(' + this.index()  + ')') )
                                    .on( 'change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );

                                        column
                                            .search( val ? '^'+val+'$' : " ", true, false )
                                            .draw();

                                        $('.filter option').remove();
                                        $('.filter').append('<option value="">Выберите...</option>');

                                    } );

                                column.data().unique().sort().each( function ( d, j ) {
                                    select.append( '<option value="'+d.replace(/"/g, '&#34;')+'">'+d+'</option>' )
                                } );

                            } );

                                this.api().columns([2, 3]).every(function () {
                                    var column = this;
                                    console.log(this.index())
                                    var select = $('<select  class="form-control filter"><option value=""></option></select>')
                                        .appendTo($('thead tr:eq(1) th:eq(' + this.index() + ')'))
                                        .on('change', function () {
                                            var val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                            );

                                            column
                                                .search(val ? '^' + val + '$' : " ", true, false)
                                                .draw();
                                        });

                                    $("#house_filter").change(function() {
                                        column.data().unique().sort().each(function (d, j) {
                                            select.append('<option value="' + d.replace(/"/g, '&#34;') + '">' + d + '</option>')
                                        });
                                    });

                                });
                            this.api().columns([4]).every( function () {
                                var column = this;
                                console.log(this.index())
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
                            this.api().columns([5]).every( function () {
                                var column = this;
                                console.log(this.index())
                                var select = $('<select class="form-control filter_house"><option value=""></option></select>')
                                    .appendTo(  $('thead tr:eq(1) th:eq(' + this.index()  + ')') )
                                    .on( 'change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()

                                        );

                                        if(val == 0){
                                            column
                                                .search( val ? '^п[1-9]\d*|0$' : " ", true, false )
                                                .draw();
                                        }
                                        if(val == 1){
                                            column
                                                .search( val ? '^-[1-9]\d*$' : " ", true, false )
                                                .draw();
                                        }
                                    } );

                                select.append( '<option value="1">Есть долг</option>' )
                                select.append( '<option value="0">Нет долга</option>' )

                            } );
                            this.api().columns(0).every( function () {
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
                        }
                    });

                } );


                //cdn.datatables.net/plug-ins/1.11.4/i18n/uk.json
            </script>


@endsection
