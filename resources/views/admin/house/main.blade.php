@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">

@endsection

@section('title')
   Дома
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
                <a class="btn btn-success pull-right" href="{{route('adminHouseCreate')}}">Добавить дом</a>
            </div>
            </div>

            <div class="col-xl-12">

                <div class="card">

                    <div class="card-header with-border">
                        <h3 class="card-title"></h3>
                        <div class="card-tools">
                            <a href="{{route('adminHouseIndex')}}" class="btn btn-default btn-sm">Очистить</a>
                        </div>
                    </div>

                <div class="card-body">


                    <table id="example" class="table table-striped table-bordered table-hover dataTable dtr-inline" style="width:100%">


                        <thead>

                        <tr>
                            <th style="max-width: 50px; width: 20px ; min-width: 10px">#</th>
                            <th scope="col"> Название</th>
                            <th scope="col">Адресс</th>
                            <th style="max-width: 100px; width: 50px; min-width: 40px"></th>

                        </tr>

                        </thead>

                        <tbody>







                        @foreach($houses as $house)
                            <tr>
                                <td></td>
                                <td><a href="{{route('adminHouseShow', $house->id)}}">{{$house->house_name}}</a></td>
                                <td>{{$house->house_address}}</td>
                                <td><a class="btn btn-info btn-sm" href="{{route('adminHouseEdit', $house->id)}}"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger btn-sm" href="{{route('adminHouseRemove', $house->id)}}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot style="display:  table-header-group">
                        <tr>


                        </tr>
                        </tfoot>
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

            <script>

                $(document).ready(function() {

                    var table = $('#example').DataTable( {
                        language: {
                            url: '{{asset('plugins/datatables/datatables_ru.json')}}',
                        },
                        orderCellsTop: true,
                        fixedHeader: true,
                        "lengthChange": false,
                        "sDom": '<"top"i>rt<"bottom"lp><"clear">',
                        "columns": [
                            {
                                "orderable":      false,
                                "targets":  0,
                                "searchable": false,
                            },
                           null,
                           null,
                            {

                                "orderable": false,
                                "searchable": false,
                                "targets":  3
                            }],

                        "order": [[ 1, 'asc' ]],

                    } );
                    table.on( 'order.dt', function () {
                        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, v) {
                            cell.innerHTML = v+1;
                        } );
                    } ).draw();



                   // Setup - add a text input to each footer cell
                    $('#example thead tr').clone(true).appendTo( '#example thead' );
                    $('#example thead tr:eq(1) th').each( function (i) {
                        var title = $(this).text();
                        if(i == 1 || i == 2) {
                            $(this).html('<input type="text" placeholder="' + title + '" class="form-control" >');
                        }
                        $( 'input', this ).on( 'keyup change', function () {
                            if ( table.column(i).search() !== this.value ) {
                                table

                                    .column(i)
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } );



                } );
                //cdn.datatables.net/plug-ins/1.11.4/i18n/uk.json
            </script>


@endsection
