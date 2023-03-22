@extends('layouts.admin')

@section('css')


@endsection

@section('title')
    Квитанция
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
                            <div class="form-control pull-right"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xl-12">
                <div class="card">

                    <div class="card-header with-border">
                        <h3 class="card-title">Просмотр квитанции</h3>
                        <div class="card-tools">
                            <a href="" class="btn btn-default btn-sm">
                                <span class="hidden-xs">Печать</span><i class="fa fa-print visible-xs"
                                                                        aria-hidden="true"></i>
                            </a>
                            <a href="" class="btn btn-default btn-sm">
                                <span class="hidden-xs">Отправить на e-mail</span><i class="fa fa-envelope-o visible-xs"
                                                                                     aria-hidden="true"></i>
                            </a>
                            <a href="{{route('admin.invoice.edit', $invoice['id'])}}" class="btn btn-primary btn-sm">
                                <span class="hidden-xs">Редактировать квитанцию</span><i class="fa fa-pencil visible-xs"
                                                                                         aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-view">
                            <tbody>
                            <tr>
                                <td>Проведена</td>
                                <td>
                                    @if($invoice['status'] == 0)
                                        <small class="btn-success btn-xs">Проведена</small>
                                    @else
                                        <small class="btn-danger btn-xs">Не проведена</small>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Статус</td>
                                <td>
                                    @if($invoice->status == 10)
                                        <small class="btn-success btn-xs">Оплачена</small>
                                    @elseif($invoice->status == 5)
                                        <small class="btn-warning text-light btn-xs">Частично оплачена</small>
                                    @else
                                        <small class="btn-danger btn-xs">Неоплачена</small>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Период</td>
                                <td>
                                    {{date('d-m-Y', strtotime($invoice['period_start']))}} -  {{date('d-m-Y', strtotime($invoice['period_end']))}}
                                </td>
                            </tr>
                            <tr>
                                <td>Владелец</td>
                                <td>
                                    <a href="{{route('userShow', $invoice->apartaments->users['id'])}}">
                                        {{$invoice->apartaments->users['lastname']}}  {{$invoice->apartaments->users['firstname']}} {{$invoice->apartaments->users['middlename']}} </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Лицевой счет</td>
                                <td>
                                    <a href="{{route('personalAccount.show', $invoice->apartaments->accounts['id'])}}">
                                        {{$invoice->apartaments->accounts['number']}} </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Телефон</td>
                                <td> {{$invoice->apartaments->users['phone']}}</td>
                            </tr>
                            <tr>
                                <td>Дом</td>
                                <td>
                                    <a href="{{route('adminHouseShow', $invoice->apartaments->houses['id'])}}">
                                        {{$invoice->apartaments->houses['house_name']}}  </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Квартира</td>
                                <td>
                                    <a href="{{route('userShow', $invoice->apartaments->users['id'])}}">
                                        {{$invoice->apartaments['number']}}  </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Секция</td>
                                <td> {{$invoice->apartaments->sections['name']}}</td>
                            </tr>
                            <tr>
                                <td>Тариф</td>
                                <td>
                                    <a href="{{route('tariff.show', $invoice->tariffs['id'])}}">
                                        {{$invoice->tariffs['name']}} </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="table-responsive no-padding margin-top-15">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 40px; min-width: 40px;">#</th>
                                    <th>Услуга</th>
                                    <th>Количество потребления (расход)</th>
                                    <th style="width: 80px; min-width: 80px;">Ед. изм.</th>
                                    <th>Цена за ед., грн</th>
                                    <th>Стоимость, грн</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <td colspan="5"></td>
                                    <td colspan="2"><b>Итого: {{$invoice['price']}}</b></td>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($invoice->invoiceService as $key => $invoiceService)
                                <tr role="row">
                                    <td>{{$key + 1}}</td>
                                    <td>{{$invoiceService->services['name']}}</td>
                                    <td>{{$invoiceService['amount']}}</td>
                                    <td>{{$invoiceService->services->units['name']}}</td>
                                    <td>{{$invoiceService['price_unit']}}</td>
                                    <td>{{$invoiceService['price']}}</td>
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
@endsection

@section('js')


@endsection
