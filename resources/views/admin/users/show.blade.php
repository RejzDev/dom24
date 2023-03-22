@extends('layouts.admin')

@section('css')


@endsection

@section('title')
    Профиль владельца
@endsection




@section('content')



    <div class="content">


        <div class="row">

            <div class="col-xl-12">
                <div class="card">


                    <div class="card-header mb-3">
                        <div class="float-right">
                            <a href="{{route('adminApartamentsEdit', $user['id'])}}" class="btn btn-primary btn-sm">
                                <span>Редактировать профиль</span><i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>


                    <!-- form start -->


                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class=" row">
                                    <div class="form-group col">
                                        <img class="img-circle pull-left img-thumbnail"
                                             src="@if(empty($user['image'])) {{asset('image/logo-mini.svg')}}  @else {{asset('/storage/' . $user['image'])}} @endif">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <table class="table table-bordered table-striped table-view">
                                    <tbody>

                                    <tr>
                                        <td>Статус</td>
                                        <td>
                                            @if($user['status'] == 1)
                                                <small class="btn-success btn-xs">Активен</small>
                                            @elseif($user['status'] == 2)
                                                <small class="btn-warning btn-xs">Новый</small>
                                            @else
                                                <small class="btn-danger btn-xs">Отключен</small>
                                            @endif
                                          </td>
                                    </tr>
                                    <tr>
                                        <td>ID</td>
                                        <td>{{$user['userid']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Фамилия</td>
                                        <td>
                                            {{$user['lastname']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Имя</td>
                                        <td>
                                            {{$user['firstname']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Отчество</td>
                                        <td>{{$user['middlename']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Дата рождения</td>
                                        <td>{{$user['birthdate']}}</td>
                                    </tr>
                                    <tr>
                                        <td>О владельце (заметки)</td>
                                        <td>
                                            {{$user['note']}}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Телефон</td>

                                        <td>
                                            {{$user['phone']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Viber</td>

                                        <td>
                                            {{$user['viber']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Telegram</td>

                                        <td>
                                            {{$user['telegram']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>

                                        <td>
                                            {{$user['email']}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

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
