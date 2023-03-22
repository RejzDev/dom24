@extends('layouts.admin')

@section('css')


@endsection

@section('title')
    Лицевой счет
@endsection




@section('content')



    <div class="content">

        <div class="row">
            <div class="col-xs-12 col-md-7 col-lg-3">
                <div class="page-header-spec">
                    <div class="form-group">
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text">№</span>
                            </div>
                            <div class="form-control pull-right">{{$accounts['number']}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xl-12">
                <div class="card">


                    <div class="card-header mb-3">
                        <h3 class="card-title">Просмотр лицевого счета</h3>
                        <div class="float-right">
                            <a href="{{route('personalAccount.edit', $accounts['id'])}}" class="btn btn-primary btn-sm">
                                <span>Редактировать лицевой счет</span><i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>


                    <!-- form start -->


                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-12">

                                <table class="table table-bordered table-striped table-view">
                                    <tbody>

                                    <tr>
                                        <td>
                                            Статус
                                        </td>
                                        <td>
                                            @if($accounts->status == 1) <small class="btn-success btn-xs">Активен</small> @else  <small class="btn-danger btn-xs">Неактивен</small> @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Дом</td>
                                        <td>@if(isset($accounts->apartaments->houses)) <a href="{{route('adminHouseShow', $accounts->apartaments->houses['id'])}}">{{$accounts->apartaments->houses['house_name']}}</a> @else не указано @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Секция</td>
                                        <td>
                                            @if(isset($accounts->apartaments->houses)) {{$accounts->apartaments->sections['name']}} @else не указано @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Квартира</td>
                                        <td>
                                            @if(isset($accounts->apartaments)) <a href="{{route('adminApartamentsShow', $accounts->apartaments['id'])}}">{{$accounts->apartaments['number']}}</a> @else не указано @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Владелец</td>
                                        <td>@if(!empty($accounts->apartaments)) <a href="{{route('userShow', $accounts->apartaments->users['id'])}}">{{$accounts->apartaments->users['lastname']}}  {{$accounts->apartaments->users['firstname']}} {{$accounts->apartaments->users['middlename']}}</a> @else не указано @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Остаток, грн.</td>
                                        <td class="@if($accounts->getBalance() < 0)text-red @else text-green @endif ">{{$accounts->getBalance()}}</td>
                                    </tr>

                                    </tbody>
                                </table>

                                <div>
                                    <p><a href="#">Посмотреть показания счетчиков</a></p>
                                    <p><a href="#">Посмотреть приходы</a></p>
                                    <p><a href="#">Посмотреть квитанции</a></p>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection

@section('js')


@endsection
