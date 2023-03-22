@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">

@endsection

@section('title')
    Роли
@endsection




@section('content')

    <div class="content">
        @if (Session::has('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
            </div>
        @endif


        <div class="row">


            <div class="col-xl-12">

                <div class="card">



                    <div class="card-body">
                        <form action="{{route('admin.roleSave')}}" method="post" enctype="multipart/form-data">
                            @csrf

                        <div class="box-body table-responsive no-padding" bis_skin_checked="1">


                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Роль</th>
                                    <th class="text-center">Статистика</th>
                                    <th class="text-center">Касса</th>
                                    <th class="text-center">Квитанции на оплату</th>
                                    <th class="text-center">Лицевые счета</th>
                                    <th class="text-center">Квартиры</th>
                                    <th class="text-center">Владельцы квартир</th>
                                    <th class="text-center">Дома</th>
                                    <th class="text-center">Сообщения</th>
                                    <th class="text-center">Заявки вызова мастера</th>
                                    <th class="text-center">Счетчики</th>
                                    <th class="text-center">Управление сайтом</th>
                                    <th class="text-center">Услуги</th>
                                    <th class="text-center">Тарифы</th>
                                    <th class="text-center">Роли</th>
                                    <th class="text-center">Пользователи</th>
                                    <th class="text-center">Платежные реквизиты</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($role as $item)
                                    <tr>
                                        <td>
                                            @if($item['name'] == 'director')
                                                Директор
                                            @elseif($item['name'] == 'manager')
                                                Управляющий
                                            @elseif($item['name'] == 'accountant')
                                                Бухгалтер
                                            @elseif($item['name'] == 'electric')
                                                Электрик
                                            @elseif($item['name'] == 'plumber')
                                                Сантехник
                                            @endif


                                        </td>
                                        @foreach($permission as $key => $permissionItem)

                                                <td class="text-center"><input type="checkbox"
                                                                               name="permissions[{{$permissionItem['name']}}][{{$item['name']}}]]"
                                                                               value="1" @if($item->hasPermissionTo($permissionItem['name'])) checked @endif></td>

                                        @endforeach
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>

                        </div>


                        <div class="text-right card-footer">

                                <a href="{{route('admin.roleIndex')}}" class="btn btn-default btn-sm">Очистить</a>

                            <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('js')


@endsection
