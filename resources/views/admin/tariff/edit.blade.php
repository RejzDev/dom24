@extends('layouts.admin')

@section('css')

    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">
@endsection

@section('title')
    Новый тариф
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
                    <form action="{{route('tariff.update', $tariff['id'])}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('PUT')


                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-lg-7">

                                    <div class="card-body">
                                        <div class="form-group" id="tariff">

                                            <div class="row">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputName">Название тарифа</label>
                                                        <input type="text" class="form-control" name="tariff[name]"
                                                               id="inputService" value="{{$tariff['name']}}">

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputDescription">Описание тарифа</label>
                                                        <textarea class="form-control " name="tariff[description]"
                                                                  id="inputDescription"
                                                                  rows="6"
                                                                  aria-invalid="false">{{$tariff['description']}}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            @foreach($tariff['tariffService'] as $tariffService)
                                                <div class="row" id="service-' + varCount + '">
                                                    <div class="col-sm-12 col-md-4">
                                                        <div class="form-group">
                                                            <label for="inputNumber">Услуга</label>
                                                            <select class="form-control"
                                                                    name="tariff[service][' +varCount+'][service_id]"
                                                                    id="service">
                                                                <option>Выберите...</option>
                                                                @foreach($data as $service)
                                                                    <option
                                                                        value="{{$service["id"]}}"
                                                                        @if($tariffService['service_id'] == $service["id"]) selected @endif>{{$service["name"]}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden"
                                                                   name="tariff[service][' +varCount+'][tariffServiceId]"
                                                                   value="{{$tariffService["id"]}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputHouse">Цена</label>
                                                            <input type="text" class="form-control"
                                                                   name="tariff[service][' +varCount+'][price]"
                                                                   id="inputPrice"
                                                                   value="{{$tariffService['price_unit']}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-2">
                                                        <div class="form-group">
                                                            <label for="inputHouse">Валюта</label>
                                                            <input type="text" class="form-control"
                                                                   name="tariff[service][' +varCount+'][currency]"
                                                                   id="inputCurrency" value="грн" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputHouse">Ед. изм.</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" disabled
                                                                       name="tariff[service][' +varCount+'][unitName]"
                                                                       id="inputNameUnit" placeholder="Выберите..."
                                                                       value="@foreach($data as $service)@if($tariffService['service_id'] == $service["id"]){{$service['units']['name']}}@endif @endforeach">
                                                                <span class="input-group-btn">
                                                                 <a href="{{route('tariffServiceRemove', $tariffService['id'])}}"
                                                                    class="btn btn-default border border-left-0"> <i
                                                                         class="fa fa-trash"></i></a>
                                                            </span>
                                                            </div>
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
                                    </div>





                            </div>
                            </div>
                            <!-- /.col -->


                            <div class="text-center card-footer">
                                <a href="{{route('tariff.index')}}" class="btn btn-default">Отменить</a>
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

            varCount = 0;
            // Новое нажатие кнопки+
            $('#serviceAdd').on('click', function () {


                $node = '<div class="row" id="service-' + varCount + '">'
                    + '<div class="col-sm-12 col-md-4">'
                    + '<div class="form-group">'
                    + '<label for="inputNumber">Услуга</label>'
                    + '<select class="form-control" name="tariff[service][' + varCount + '][service_id]" id="service">'
                    + ' <option>Выберите...</option>'
                    @foreach($data as $service)
                    + '<option value="{{$service["id"]}}">{{$service["name"]}}</option>'
                    @endforeach
                    + '</select>'
                    + '  <input type="hidden" name="tariff[service][' + varCount + '][tariffServiceId]" value="">'
                    + '</div>'
                    + '</div>'

                    + '<div class="col-sm-12 col-md-3">'
                    + '<div class="form-group">'
                    + '<label for="inputHouse">Цена</label>'
                    + '<input type="text" class="form-control" name="tariff[service][' + varCount + '][price]" id="inputPrice" value="">'
                    + '</div>'
                    + '</div>'

                    + '<div class="col-sm-12 col-md-2">'
                    + '<div class="form-group">'
                    + '<label for="inputHouse">Валюта</label>'
                    + '<input type="text" class="form-control"  name="tariff[service][' + varCount + '][currency]" id="inputCurrency"value=" грн" disabled>'
                    + '</div>'
                    + '</div>'

                    + '<div class="col-sm-12 col-md-3">'
                    + '<div class="form-group">'
                    + '<label for="inputHouse">Ед. изм.</label>'
                    + '<div class="input-group mb-3">'
                    + '<input type="text" class="form-control" disabled name="tariff[service][' + varCount + '][unitName]" id="inputNameUnit" placeholder="Выберите..." value="">'
                    + '<span class="input-group-btn">'
                    + ' <button type="button" class="btn btn-default border border-left-0 removeVar " id="' + varCount + '"><i class="fa fa-trash"></i></button>'
                    + ' </span>'
                    + '</div>'
                    + '</div>'
                    + '</div>';


                // Новый элемент формы добавляется перед кнопкой "новая"
                $('#tariff').append($node);

                varCount++;

            });
            // Удалить нажатие кнопки
            $('form').on('click', '.removeVar', function () {
                $('#service-' + this.id + '').remove();
                varCount--;
            });


        });


        jQuery(function ($) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
            // user role
            $(document).on('change', '#service', function (e) {
                var selector = $(this);
                $.ajax({
                    url: '/admin-panel/ajax-service-units/' + selector.val(),
                    type: "GET",
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (json) {
                        console.log(json);
                        $('input[id="inputNameUnit"]').val(json.units.name);
                        $('input[id="inputUnit"]').val(json.units.id);
                    }
                });
            });

        });


    </script>

@endsection
