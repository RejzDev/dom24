@extends('layouts.admin')

@section('css')


@endsection

@section('title')
  Квартира {{$apartaments['number']}}
@endsection




@section('content')



    <div class="content">


        <div class="row">

            <div class="col-xl-12">
                <div class="card">


                    <div class="card-header mb-3">
                        <h3 class="card-title">Просмотр квартиры</h3>
                        <div class="float-right">
                            <a href="{{route('adminApartamentsEdit', $apartaments['id'])}}" class="btn btn-primary btn-sm">
                                <span>Редактировать квартиру</span><i class="fa fa-pencil" aria-hidden="true"></i>
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
                                        <td>Лицевой счет</td>
                                        <td>
                                           @if(!empty($apartaments['accounts'])) <a href="#">{{$apartaments['accounts']['number']}}</a> @else не указано @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Номер квартиры</td>
                                        <td>{{$apartaments['number']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Площадь</td>
                                        <td>
                                            {{$apartaments['square']}}м<sup>2</sup>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Дом</td>
                                        <td>
                                            <a href="/admin/house/2">{{$apartaments['houses']['house_name']}} </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Секция</td>
                                        <td>@if(!empty($apartaments['sections']['name'])) {{$apartaments['sections']['name']}} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Этаж</td>
                                        <td>@if(!empty($apartaments['flours']['name'])) {{$apartaments['flours']['name']}} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Владелец</td>
                                        <td>
                                            @if(!empty($apartaments['users'])) <a href="#">{{$apartaments['users']['lastname']}} {{$apartaments['users']['firstname']}} {{$apartaments['users']['middlename']}}</a> @else не указано @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Тариф</td>

                                        <td>
                                            @if(!empty($apartaments['tariffs'])) <a href="#">{{$apartaments['tariffs']['name']}}</a> @else не указано @endif
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
