@extends('layouts.admin')

@section('css')

    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">
@endsection

@section('title')
    Новая квитанция
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
                <form action="{{route('admin.invoice.store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-5 col-lg-3 mt-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">№</span>
                                    </div>
                                    <input type="text" id="invoice-number" class="form-control" name="invoice[number]"
                                           value="{{$invoiceUid + 1}}"
                                           aria-required="true">



                                </div>
                            </div>


                            <span class="form-label m-2">от</span>

                            <div class="form-group col-sm-12 col-md-5 col-lg-3">

                                <div class="input-group date datepicker" id="datepicker">
                                    <span class="input-group-prepend">
                                            <span class="input-group-text bg-white">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                     </span>
                                    <input type="text" class="form-control" name="invoice[uid_date]"
                                           value="@if(isset($invoice)){{$invoice['uid_date']}} @endif">

                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="card">


                        <!-- form start -->


                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="card-body">
                                        <div class="form-group">

                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputHouse">Дом</label>
                                                        <select class="form-control" name="invoice[status]"
                                                                id="house_id">
                                                            <option value="">Выберите...</option>
                                                            @foreach($houses as $house)
                                                                <option
                                                                    value="{{$house['id']}}"
                                                                    @if(isset($invoice->apartaments->houses) && $house['id'] == $invoice->apartaments->houses['id']) selected
                                                                    @elseif(isset($personalAccount->apartaments->houses) && $house['id'] == $personalAccount->apartaments->houses['id']) selected @endif>{{$house['house_name']}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputName">Секция</label>

                                                        <select class="form-control" name="section_id" id="section_id">
                                                            <option value="">Выберите...</option>
                                                            @if(isset($invoice))
                                                                @foreach($invoice->apartaments->houses->sections as $section)
                                                                    <option
                                                                        value="{{$section['id']}}"
                                                                        @if($section['id'] == $invoice->apartaments->sections['id']) selected @endif>{{$section['name']}}</option>
                                                                @endforeach
                                                            @endif

                                                        </select>


                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputName">Квартира</label>
                                                        <select class="form-control" name="invoice[apartamets_id]"
                                                                id="apartments">
                                                            <option value="">Выберите...</option>
                                                            @if(isset($invoice))
                                                                @foreach($invoice->apartaments->sections->apartaments as $apartament)
                                                                    <option
                                                                        value="{{$apartament['id']}}"
                                                                        @if($apartament['id'] == $invoice->apartaments['id']) selected @endif>{{$apartament['number']}}</option>
                                                                @endforeach
                                                            @endif

                                                        </select>

                                                    </div>

                                                </div>

                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">

                                                        <input type="hidden" name="invoice[is_checked]"
                                                               value="0">
                                                        <label><input type="checkbox" id="invoice-is_checked"
                                                                      name="invoice[is_checked]" value="1"
                                                                      @if(isset($invoice) && $invoice['is_checked'] == 1)
                                                                          checked
                                                                @endif>Проведена</label>


                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputName">Статус</label>
                                                        <select class="form-control" name="invoice[status]"
                                                                id="account-status">
                                                            <option value="">Выберите...</option>
                                                            <option value="10"
                                                                    @if(isset($invoice) && $invoice['status'] == 10) selected @endif>
                                                                Оплачена
                                                            </option>
                                                            <option value="5"
                                                                    @if(isset($invoice) && $invoice['status'] == 5) selected @endif>
                                                                Частично оплачена
                                                            </option>
                                                            <option value="0"
                                                                    @if(isset($invoice) && $invoice['status'] == 0) selected @endif>
                                                                Неоплачена
                                                            </option>
                                                        </select>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputName">Тариф</label>
                                                        <select class="form-control" name="invoice[tariff_id]"
                                                                id="tariff_id">
                                                            <option value="">Выберите...</option>

                                                                @foreach($tariffs as $tariff)
                                                                    <option value="{{$tariff['id']}}"

                                                                            @if(isset($invoice) && $invoice['tariff_id'] == $tariff['id']) selected @endif>{{$tariff['name']}}</option>
                                                                @endforeach



                                                        </select>

                                                    </div>


                                                    <div class="form-group row">
                                                        <div class="input-group date col-md-6 datepicker"
                                                             id="datepicker">
                                                                <span class="input-group-append">
                                                                       <span class="input-group-text bg-white d-block">
                                                                           <i class="fa fa-calendar"></i>
                                                                       </span>
                                                                </span>
                                                            <input type="text" class="form-control"
                                                                   name="invoice[period_start]"
                                                                   value="@if(isset($invoice)){{date('d-m-Y', strtotime($invoice['period_start']))}}@endif">

                                                        </div>

                                                        <div class="input-group date col-md-6 datepicker"
                                                             id="datepicker">
                                                               <span class="input-group-append">
                                                                      <span class="input-group-text bg-white d-block">
                                                                          <i class="fa fa-calendar"></i>
                                                                      </span>
                                                               </span>
                                                            <input type="text" class="form-control"
                                                                   name="invoice[period_end]"
                                                                   value="@if(isset($invoice)){{date('d-m-Y', strtotime($invoice['period_end']))}}@endif">

                                                        </div>

                                                    </div>


                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="account_uid">Лицевой счет</label>
                                                    <input type="text" id="account_number" class="form-control"
                                                           name="account_number"
                                                           value="@if(isset($invoice)){{$invoice->apartaments->accounts['number']}}@endif">

                                                    <input type="hidden" id="account_numberId" class="form-control"
                                                           name="account_numberId"
                                                           value="@if(isset($invoice)){{$invoice->apartaments->accounts['id']}}@endif">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <p><b>Владелец:</b> <span id="user-fullname">
                                                        @if(isset($invoice))
                                                            {{$invoice->apartaments->users['lastname']}}  {{$invoice->apartaments->users['firstname']}} {{$invoice->apartaments->users['middlename']}}
                                                        @endif
                                                        </span></p>
                                                <p><b>Телефон:</b> <span id="user-phone">
                                                        @if(isset($invoice))
                                                            {{$invoice->apartaments->users['phone']}}
                                                        @endif
                                                        </span></p>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="table-responsive ">
                                                        <table class="table table-bordered table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th style="min-width: 200px;">Услуга</th>
                                                                <!--<th style="min-width: 180px;">Показания</th>-->
                                                                <th style="min-width: 180px;">Расход</th>
                                                                <th style="min-width: 120px;">Ед. изм.</th>
                                                                <th style="min-width: 180px;">Цена за ед., грн.</th>
                                                                <th style="min-width: 180px;">Стоимость, грн.</th>
                                                                <th style="width: 40px; min-width: 40px;"></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="invoiceService">
                                                            @if(isset($invoice))
                                                                @foreach($invoice->invoiceService as $key => $invoiceService)
                                                                    <tr id="invoiceService-1" class="invoiceService">
                                                                        <td><input type="hidden" id="invoiceServiceId-1"
                                                                                   name="invoiceService[{{$key}}][id]">
                                                                            <select id="invoiceServiceId"
                                                                                    class="form-control invoiceServiceId"
                                                                                    name="invoiceService[{{$key}}][service_id]">
                                                                                <option value="">Выберите...</option>
                                                                                @foreach($services as $service)
                                                                                    <option value="{{$service['id']}}"
                                                                                            @if($service['id'] == $invoiceService['service_id']) selected @endif>{{$service['name']}}</option>
                                                                                @endforeach
                                                                            </select></td>
                                                                        <td>
                                                                            <input type="text"
                                                                                   id="invoiceServiceAmount-1"
                                                                                   class="form-control service-amount"
                                                                                   name="invoiceService[{{$key}}][amount]"
                                                                                   value="{{$invoiceService['amount']}}">
                                                                        </td>
                                                                        <td><select id="unit-1"
                                                                                    class="form-control unit"
                                                                                    name="unit[{{$key}}]">
                                                                                <option value="">Выберите...</option>
                                                                                @foreach($units as $unit)
                                                                                    <option value="{{$unit['id']}}"
                                                                                            @if($unit['id'] == $invoiceService->services->units['id']) selected @endif>{{$unit['name']}}</option>
                                                                                @endforeach
                                                                            </select></td>
                                                                        <td>
                                                                            <input type="text"
                                                                                   id="invoiceServicePriceUnit-1"
                                                                                   class="form-control service-price-unit"
                                                                                   name="invoiceService[{{$key}}][price_unit]"
                                                                                   value="{{$invoiceService['price_unit']}}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text"
                                                                                   id="invoiceServicePrice-1"
                                                                                   class="form-control service-price"
                                                                                   name="invoiceService[{{$key}}][price]"
                                                                                   value="{{$invoiceService['price']}}">
                                                                        </td>
                                                                        <td>
                                                                            <a href="{{route('admin.invoiceServiceRemove', $invoiceService['id'])}}"
                                                                               class="btn btn-default border border-left-0">
                                                                                <i class="fa fa-trash"></i></a>
                                                                        </td>
                                                                    </tr>

                                                                @endforeach
                                                            @endif


                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <button type="button"
                                                                            class="btn btn-default btn-hover-change"
                                                                            id="serviceAdd">
                                                                        Добавить услугу
                                                                    </button>
                                                                    <button type="button" id="add-tariff-service"
                                                                            class="btn btn-default">
                                                                        Установить все услуги согласно тарифу
                                                                    </button>

                                                                </td>
                                                                <td style="min-width: 180px;">
                                                                    <div class="h4">
                                                                        Итого: <b><span id="total-price">@if(isset($invoice)){{$invoice['price']}} @else 0.00 @endif</span></b>
                                                                        грн
                                                                    </div>
                                                                </td>
                                                                <td style="width: 40px; min-width: 40px;"></td>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- /.col -->


                        <div class="text-center card-footer">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>


                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection

@section('js')

    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datepicker/ru.js')}}"></script>


    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>


        jQuery(function ($) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            @if(isset($invoice))
             varCount = {{count($invoice->invoiceService)}}
                @else
                varCount = 0;
            @endif

            $(document).on('change', '#house_id', function (e) {
                var selector = $(this);
                $('#section_id option').remove();
                $('#section_id').append('<option value="">Выберите...</option>');

                $.ajax({
                    url: '/admin-panel/get-house-id/' + selector.val(),
                    type: "GET",
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (json) {

                        json['sections'].forEach(function (section, key) {

                            $('#section_id').append('<option value="' + section["id"] + '"> ' + section["name"] + '</option>');

                        })

                    }
                });
            });


            $(document).on('change', '#section_id', function (e) {
                var selector = $(this);
                $('#apartments option').remove();
                $('#apartments').append('<option value="">Выберите...</option>');
                $.ajax({
                    url: '/admin-panel/get-section-id/' + selector.val(),
                    type: "GET",
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (json) {

                        json['apartaments'].forEach(function (apartments, key) {

                            $('#apartments').append('<option value="' + apartments["id"] + '"> ' + apartments["number"] + '</option>');


                        })
                    }
                });
            });

            $(document).on('change', '#apartments', function (e) {
                var selector = $(this);

                $.ajax({
                    url: '/admin-panel/get-apartaments-id/' + selector.val(),
                    type: "GET",
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (json) {
                        var lastName = '';
                        var firstName = ''
                        var middleName = '';

                        if (json['users']['lastname'] !== null) {
                            lastName = json['users']['lastname']
                        }
                        ;
                        if (json['users']['firstname'] !== null) {
                            firstName = json['users']['firstname']
                        }
                        ;
                        if (json['users']['middlename'] !== null) {
                            middleName = json['users']['middlename']
                        }
                        ;

                        $("#user-fullname").html(lastName + ' ' + firstName + ' ' + middleName);

                        $("#user-phone").html(json['users']['phone']);
                        $('input[id="account_number"]').val(json['accounts']['number']);

                    }
                });
            });


            $(document).on('change', '#invoiceServiceId', function (e) {
                var rows = $(this).parents('.invoiceService');
                var id = parseInt(rows.find('select.invoiceServiceId').val());


                $.ajax({
                    url: '/admin-panel/ajax-service-units/' + id,
                    type: "GET",
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (json) {
                        rows.find('.unit option[value=' + json["units"]["id"] + ']').removeAttr("selected", "selected");
                        rows.find('.unit option[value=' + json["units"]["id"] + ']').attr("selected", "selected");

                        console.log(json['units']);
                    }
                });
            });

            $(document).on('change', '#account_number', function (e) {

                $('#section_id option').remove();
                $('#section_id').append('<option value="">Выберите...</option>');

                $('#apartments option').remove();
                $('#apartments').append('<option value="">Выберите...</option>');


                var number = $(this).val();

                $.ajax({
                    url: '/personalAccount-get-id/' + number,
                    type: "GET",
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (json) {


                        $('#house_id option[value=' + json["house"]["id"] + ']').attr("selected", "selected");
                        $('#section_id').append('<option value="' + json["section"]["id"] + '" selected> ' + json["section"]["name"] + '</option>');
                        $('#apartments').append('<option value="' + json["apartaments"]["id"] + '" selected> ' + json["apartaments"]["number"] + '</option>');


                    }
                });
            });

            $(document).on('click', '#add-tariff-service', function (e) {
                var rows = $(this).parents('.invoiceService');
                $('.invoiceService').remove();
                console.log($('#tariff_id').val());
                varCount++;
                $.ajax({
                    url: '/tariff/get-tariff-id/' + $('#tariff_id').val(),
                    type: "GET",
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (json) {


                        json['tariffServices'].forEach(function (tariffService, key) {

                            console.log(tariffService);

                            $node = '<tr id="invoiceService-' + varCount + '" class="invoiceService"> ' +
                                '<td>' +
                                '<input type="hidden" id="invoiceServiceId-' + varCount + '" name="invoiceService[' + varCount + '][id]">' +
                                '<input type="hidden" id="invoiceserviceInvoiceId-' + varCount + '" name="invoiceService[' + varCount + '][invoice_id]" value="0">' +
                                '<select id="invoiceServiceId" class="form-control invoiceServiceId" name="invoiceService[' + varCount + '][service_id]">' +
                                ' <option value="">Выберите...</option>' +
                                @foreach($services as $service)
                                    '<option value="{{$service['id']}}">{{$service['name']}}</option>' +
                                @endforeach
                                    '</select>' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" id="invoiceServiceAmount-' + varCount + '" class="form-control service-amount" name="invoiceService[' + varCount + '][amount]">' +
                                '</td>' +
                                '<td>' +
                                '<select id="unit-' + varCount + '" class="form-control unit" name="unit[' + varCount + ']">' +
                                '<option value="">Выберите...</option>' +
                                @foreach($units as $unit)
                                    '<option value="{{$unit['id']}}">{{$unit['name']}}</option>' +
                                @endforeach
                                    '</select>' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" id="invoiceServicePriceUnit-' + varCount + '" class="form-control service-price-unit" name="invoiceService[' + varCount + '][price_unit]" value="' + tariffService["price_unit"] + '">' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" id="invoiceServicePrice-' + varCount + '" class="form-control service-price" name="invoiceService[' + varCount + '][price]">' +
                                '</td>' +
                                '<td>' +
                                '<button type="button" class="btn btn-default btn-sm removeVar" id="' + varCount + '" title="Удалить услугу"><i class="fa fa-trash"></i></button>' +
                                '</td>' +
                                '</tr>';

                            // Новый элемент формы добавляется перед кнопкой "новая"
                            $('#invoiceService').append($node);


                            $('.invoiceServiceId option[value=' + tariffService["service_id"] + ']').attr("selected", "selected");

                            json['services'].forEach(function (service, key) {

                                if (service["id"] == tariffService["service_id"]) {
                                    $('.unit option[value=' + service["service_unit_id"] + ']').attr("selected", "selected");
                                }
                            })
                        })


                    }

                });

            });


        });

        $(function () {

            $.fn.datepicker.dates['ru'] = {
                days: ["воскресенье", "понедельник", "вторник", "среда", "четверг", "пятница", "суббота"],
                daysShort: ["вск", "пнд", "втр", "срд", "чтв", "птн", "сбт"],
                daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
                    "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
                monthsShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн",
                    "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
                today: "Сегодня",
                clear: "Очистить",
                format: "dd-mm-yyyy",
                titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
                weekStart: 0
            };

            @if(isset($invoice))
            $('.datepicker').datepicker({
                language: 'ru',
            });
                @else
                $('.datepicker').datepicker({
                language: 'ru',
            }).datepicker('setDate', 'today');
            @endif
        });


        $(function () {

            $(document).on('click', '#remove-btn', function (e) {
                var msg = $(this).attr('no-delete-message');
                alert(msg);
            });

            varCount++;
            // Новое нажатие кнопки+
            $('#serviceAdd').on('click', function () {


                $node = '<tr id="invoiceService-' + varCount + '" class="invoiceService"> ' +
                    '<td>' +
                    '<input type="hidden" id="invoiceServiceId-' + varCount + '" name="invoiceService[' + varCount + '][id]">' +
                    '<input type="hidden" id="invoiceserviceInvoiceId-' + varCount + '" name="invoiceService[' + varCount + '][invoice_id]" value="0">' +
                    '<select id="invoiceServiceId" class="form-control invoiceServiceId" name="invoiceService[' + varCount + '][service_id]">' +
                    ' <option value="">Выберите...</option>' +
                    @foreach($services as $service)
                        '<option value="{{$service['id']}}">{{$service['name']}}</option>' +
                    @endforeach
                        '</select>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" id="invoiceServiceAmount-' + varCount + '" class="form-control service-amount" name="invoiceService[' + varCount + '][amount]">' +
                    '</td>' +
                    '<td>' +
                    '<select id="unit-' + varCount + '" class="form-control unit" name="unit[' + varCount + ']">' +
                    '<option value="">Выберите...</option>' +
                    @foreach($units as $unit)
                        '<option value="{{$unit['id']}}">{{$unit['name']}}</option>' +
                    @endforeach
                        '</select>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" id="invoiceServicePriceUnit-' + varCount + '" class="form-control service-price-unit" name="invoiceService[' + varCount + '][price_unit]">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" id="invoiceServicePrice-' + varCount + '" class="form-control service-price" name="invoiceService[' + varCount + '][price]">' +
                    '</td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-default btn-sm removeVar" id="' + varCount + '" title="Удалить услугу"><i class="fa fa-trash"></i></button>' +
                    '</td>' +
                    '</tr>';

                // Новый элемент формы добавляется перед кнопкой "новая"
                $('#invoiceService').append($node);


            });
            // Удалить нажатие кнопки
            $('form').on('click', '.removeVar', function () {
                console.log(this.id);
                $('#invoiceService-' + this.id + '').remove();
                updateTotalPrice();
                varCount--;
            });


        });


        $(document).on('blur', '.service-price-unit, .service-amount', function (e) {
            var rows = $(this).parents('.invoiceService');

            var amount = parseFloat(rows.find('input.service-amount').val());
            var priceUnit = parseFloat(rows.find('input.service-price-unit').val());
            var price = (amount * priceUnit).toFixed(2);


            if (isNaN(price)) {
                price = 0;
            }

            rows.find('input.service-price').val(price).trigger('change');
            updateTotalPrice();
        });


        function updateTotalPrice() {
            var priceTotal = 0;
            $('.service-price').each(function (e) {
                priceTotal += parseFloat($(this).val()) || 0;

            });
            $('#total-price').text(priceTotal.toFixed(2));
        }


    </script>

@endsection
