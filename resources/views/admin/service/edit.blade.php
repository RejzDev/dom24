@extends('layouts.admin')

@section('css')

    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">
@endsection

@section('title')
    Редактирование услуг
@endsection




@section('content')

    <div class="content">
        @if (Session::has('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">

            <div class="col-xl-12">
                <div class="card">


                    <!-- form start -->
                    <form action="{{route('saveService')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}


                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-lg-7">

                                    <div class="card-body">
                                        <div class=" card-primary card-outline card-outline-tabs border-top-0">
                                            <div class="card-header p-0 border-bottom-0">
                                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="custom-tabs-four-home-tab"
                                                           data-toggle="pill" href="#custom-tabs-four-home" role="tab"
                                                           aria-controls="custom-tabs-four-home" aria-selected="true">Услуги</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="custom-tabs-four-profile-tab"
                                                           data-toggle="pill" href="#custom-tabs-four-profile"
                                                           role="tab" aria-controls="custom-tabs-four-profile"
                                                           aria-selected="false">Единицы измерения</a>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                                    <div class="tab-pane fade active show" id="custom-tabs-four-home"
                                                         role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                                        <div class="form-group" id="services">
                                                            @foreach($data['services'] as $key =>$service)
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-7">
                                                                        <div class="form-group">
                                                                            <label for="inputNumber">Услуга</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="service[{{$key}}][name]"
                                                                                   id="inputService"
                                                                                   value="{{$service['name']}}">
                                                                            <input type="hidden"
                                                                                   name="service[{{$key}}][id]"
                                                                                   value="{{$service['id']}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12 col-md-5">
                                                                        <div class="form-group">
                                                                            <label for="inputHouse">Ед. изм.</label>

                                                                            <div class="input-group mb-3">
                                                                                <select class="form-control"
                                                                                        name="service[{{$key}}][serviceUnit]"
                                                                                        id="serviceUnit">
                                                                                    <option>Выберите...</option>
                                                                                    @foreach($data['units'] as $unit)
                                                                                        <option value="{{$unit['id']}}"
                                                                                                @if($service['service_unit_id'] === $unit['id']) selected @endif>{{$unit['name']}}</option>
                                                                                    @endforeach

                                                                                </select>
                                                                                <span class="input-group-btn">
                                                                        <a href="{{route('serviceRemove', $service['id'])}}"
                                                                           class="btn btn-default border border-left-0">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>
                                                                    </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-12">
                                                                        <div class="form-group">
                                                                            <input type="hidden"
                                                                                   name="service[{{$key}}][is_counter]"
                                                                                   value="0">
                                                                            <label> <input type="checkbox"
                                                                                           @if($service['is_counter'] === 1) checked
                                                                                           @endif name="service[{{$key}}][is_counter]"
                                                                                           value="1"> Показывать в
                                                                                счетчиках </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <button type="button" class="btn btn-outline-primary"
                                                                id="serviceAdd">
                                                            Добавить услугу
                                                        </button>
                                                    </div>
                                                    <div class="tab-pane fade" id="custom-tabs-four-profile"
                                                         role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">


                                                        <div class="form-group" id="unit">
                                                            @foreach($data['units'] as $key => $unit)

                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-7">
                                                                        <div class="form-group">
                                                                            <label for="inputUnit">Ед. изм.</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="text" class="form-control"
                                                                                       name="unit[{{$key}}][name]"
                                                                                       id="inputUnit"
                                                                                       value="{{$unit['name']}}">
                                                                                <input type="hidden"
                                                                                       name="unit[{{$key}}][id]"
                                                                                       value="{{$unit['id']}}">

                                                                                <span class="input-group-btn">
                                                                                @if(!empty($unit['service'][0]))
                                                                                        <button type="button"
                                                                                                class="btn btn-default disabled"
                                                                                                no-delete-message="Эта ед.изм. используется в услуге. Удаление невозможно."
                                                                                                id="remove-btn"><i
                                                                                                class="fa fa-trash"></i></button>
                                                                                    @else
                                                                                        <a href="{{route('unitRemove', $unit['id'])}}"
                                                                                           class="btn btn-default border border-left-0"> <i
                                                                                                class="fa fa-trash"></i></a>
                                                                                    @endif

                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <button type="button" class="btn btn-outline-primary"
                                                                id="unitAdd">
                                                            Добавить Ед. изм.
                                                        </button>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>


                        </div>
                        <!-- /.col -->


                </div>


                <div class="text-center card-footer">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>

                </form>


            </div>

        </div>
    </div>

    </div>
@endsection

@section('js')

    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

    <script>


        $(function () {

            $(document).on('click', '#remove-btn', function (e) {
                var msg = $(this).attr('no-delete-message');
                alert(msg);
            });

            varCount = {{count($data['services'])}};
            // Новое нажатие кнопки+
            $('#serviceAdd').on('click', function () {


                $node = '<div class="row" id="service-' + varCount + '">'
                    + '<div class="col-sm-12 col-md-7">'
                    + '<div class="form-group">'
                    + '<label for="inputNumber">Услуга</label>'
                    + '<input type="text" class="form-control" name="service[' + varCount + '][name]" id="inputService">'
                    + '  <input type="hidden" name="service[' + varCount + '][id]" value="">'
                    + '</div>'
                    + '</div>'
                    + '<div class="col-sm-12 col-md-5">'
                    + '<div class="form-group">'
                    + '<label for="inputHouse">Ед. изм.</label>'
                    + '<div class="input-group mb-3">'
                    + '<select class="form-control" name="service[' + varCount + '][serviceUnit]" id="serviceUnit">'
                    + ' <option>Выберите...</option>'
                    @foreach($data['units'] as $unit)
                    + '<option value="{{$unit["id"]}}">{{$unit["name"]}}</option>'
                    @endforeach
                    + '</select>'
                    + '<span class="input-group-btn">'
                    + ' <button type="button" class="btn btn-default border border-left-0 removeVar" id="' + varCount + '"><i class="fa fa-trash"></i></button>'
                    + ' </span>'
                    + '</div>'
                    + '</div>'
                    + '</div>'
                    + '<div class="col-xs-12">'
                    + '<div class="form-group">'
                    + '<input type="hidden" name="service[' + varCount + '][is_counter]" value="0">'
                    + '<label> <input type="checkbox" name="service[' + varCount + '][is_counter]" value="1"> Показывать в счетчиках </label>'
                    + '</div>'
                    + '</div>'
                    + '</div>';


                // Новый элемент формы добавляется перед кнопкой "новая"
                $('#services').append($node);

                varCount++;

            });
            // Удалить нажатие кнопки
            $('form').on('click', '.removeVar', function () {
                $('#service-' + this.id + '').remove();
                varCount--;
            });
        });


        $(function () {

            varUnite = {{count($data['units'])}};
            console.log(varUnite);
            // Новое нажатие кнопки+
            $('#unitAdd').on('click', function () {


                $unitHtlm = '<div class="row" id="unit-' + varUnite + '">'
                    + '<div class="col-sm-12 col-md-7">'
                    + '<div class="form-group">'
                    + '<label for="inputHouse">Ед. изм.</label>'
                    + '<div class="input-group mb-3">'
                    + '<input type="text" class="form-control" name="unit[' + varUnite + '][name]" id="inputService">'
                    + ' <input type="hidden" name="unit[' + varUnite + '][id]" value="">'
                    + '<span class="input-group-btn">'
                    + ' <button type="button" class="btn btn-default border border-left-0 removeUnit" id="' + varUnite + '"><i class="fa fa-trash"></i></button>'
                    + ' </span>'
                    + '</div>'
                    + '</div>'
                    + '</div>'
                    + '</div>'
                    + '</div>';


                // Новый элемент формы добавляется перед кнопкой "новая"
                $('#unit').append($unitHtlm);

                varUnite++;

            });
            // Удалить нажатие кнопки
            $('form').on('click', '.removeUnit', function () {
                $('#unit-' + this.id + '').remove();
                varUnite--;
            });
        });


    </script>

@endsection
