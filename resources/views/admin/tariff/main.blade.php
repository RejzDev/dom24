@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">

@endsection

@section('title')
    Тарифы
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
                    <a class="btn btn-success pull-right" href="{{route('tariff.create')}}">Добавить тариф</a>
                </div>
            </div>

            <div class="col-xl-12">

                <div class="card">

                    <div class="card-body">


                        <table id="apartment"
                               class="table table-striped table-bordered table-hover dataTable dtr-inline"
                               style="width:100%">


                            <thead>

                            <tr>
                                <th><small>Название тарифа</small></th>
                                <th><small>Описание тарифа</small></th>
                                <th><small>Дата редактирования</small></th>
                                <th style="max-width: 100px; width: 80px; min-width: 40px"></th>

                            </tr>

                            </thead>

                            <tbody>


                            @foreach($data as $key =>$tariff)

                                <tr onclick="window.location.href='{{route('tariff.show', $tariff->id)}}'" style="cursor:pointer">
                                    <td class="small">{{$tariff->name}}</td>
                                    <td class="small">{{substr($tariff->description, 0, 100)}}...</td>
                                    <td class="small">{{date('d.m.Y - H:i', strtotime($tariff->updated_at))}}</td>

                                    <td>
                                        <form method="POST" action="{{route('tariff.destroy', $tariff->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-default btn-xs "
                                               href="{{route('createClone', $tariff->id)}}"><i class="fas fa-clone"></i></a>
                                            <a class="btn btn-default btn-xs "
                                               href="{{route('tariff.edit', $tariff->id)}}"><i
                                                    class="fas fa-pencil-alt"></i></a>

                                            <button type="submit" class="btn btn-default btn-xs"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
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

        $(document).ready(function () {
            var table = $('#apartment').DataTable({
                "language": {
                    "url": '{{asset('plugins/datatables/datatables_ru.json')}}',
                },

                "bInfo": false,
                "orderCellsTop": true,
                "fixedHeader": true,
                "lengthChange": false,
                "sDom": '<"top"i>rt<"bottom"lp><"clear">',
                "columns": [
                    null,
                    {
                        "orderable": false,
                        "targets": 1

                    },
                    {
                        "orderable": false,
                        "targets": 2

                    },
                    {

                        "orderable": false,
                        "searchable": false,
                        "targets": 3

                    }],

                "order": [[0, 'desc']],

            });

        });


        //cdn.datatables.net/plug-ins/1.11.4/i18n/uk.json
    </script>

@endsection
