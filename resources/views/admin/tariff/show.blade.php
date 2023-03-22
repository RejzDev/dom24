@extends('layouts.admin')

@section('css')


@endsection

@section('title')
    Тариф: {{$tariff['name']}}
@endsection




@section('content')



    <div class="content">


        <div class="row">

            <div class="col-xl-12">
                <div class="card">


                    <div class="card-header mb-3">
                        <div class="float-right">
                            <a href="{{route('tariff.edit', $tariff['id'])}}" class="btn btn-primary btn-sm">
                                <span>Редактировать тариф</span><i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>


                    <!-- form start -->


                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-12">

                                <div class="box-body">
                                    <table class="table table-bordered table-striped table-view">
                                        <tbody>
                                        <tr>
                                            <td>Название тарифа</td>
                                            <td>
                                                {{$tariff['name']}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Описание</td>
                                            <td>{{$tariff['description']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Дата редактирования</td>
                                            <td>{{date('d.m.Y - H:i', strtotime($tariff->updated_at))}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="table-responsive no-padding margin-top-15">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Услуга</th>
                                                <th>Ед. изм.</th>
                                                <th>Цена за ед., грн</th>
                                                <th>Валюта</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($tariff['tariffService'] as $key => $tariffService)
                                            <tr role="row">
                                                <td>{{$key+1}}</td>
                                                <td>{{$tariffService->service->name}}</td>
                                                <td>{{$tariffService->service->units->name}}</td>
                                                <td>{{$tariffService['price_unit']}}</td>
                                                <td>грн</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
