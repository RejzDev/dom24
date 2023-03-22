@extends('layouts.admin')

@section('css')


@endsection

@section('title')
    Настройка шаблонов
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
                            <a href="" class="btn btn-primary btn-sm">
                                <span class="hidden-xs">Редактировать квитанцию</span><i class="fa fa-pencil visible-xs"
                                                                                         aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive no-padding margin-top-15">

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
