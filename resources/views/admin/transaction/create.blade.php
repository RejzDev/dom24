@extends('layouts.admin')

@section('css')

    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">
@endsection

@section('title')

    @if(request()->get('type') == 'out')   Новая расходная ведомость @else   Новая приходная ведомость @endif
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
                <form action="{{route('admin.account-transaction.store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-5 col-lg-3 mt-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">№</span>
                                    </div>
                                    <input type="text" id="transaction-number" class="form-control"
                                           name="transaction[number]"
                                           value="{{$transactionUid}}"
                                           aria-required="true">

                                    <input type="hidden" id="transaction-type" class="form-control"
                                           name="transaction[type]"
                                           value="@if(request()->get('type') == 'out') out @else in @endif"
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
                                    <input type="text" class="form-control" name="transaction[uid_date]"
                                           value="">

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

                                            <div class="col-xl-12 col-md-6 offset-6">

                                                <label><input type="checkbox" id="transaction-is_checked"
                                                              name="invoice[is_checked]" value="1">Проведена</label>


                                            </div>

                                            <div class="row">


                                                <div class="col-sm-12 col-md-6">
                                                    @if(request()->get('type') != 'out')
                                                    <div class="form-group">
                                                        <label for="inputUser">Владелец квартиры</label>
                                                        <select class="form-control" name="user_id"
                                                                id="user_id">
                                                            <option value="">Выберите...</option>
                                                            @foreach($users as $user)
                                                                <option value="{{$user['id']}}"> {{$user['lastname']}}  {{$user['firstname']}} {{$user['middlename']}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>



                                                    <div class="form-group">
                                                        <label for="inputAccount">Лицевой счет</label>
                                                        <select class="form-control" name="transaction[account_id]"
                                                                id="account_id">
                                                            <option value="">Выберите...</option>

                                                            @foreach($accounts as $account)
                                                            <option value="{{$account['id']}}">{{$account['number']}}</option>
                                                            @endforeach

                                                        </select>

                                                    </div>

                                                    @endif
                                                    <div class="form-group">
                                                        <label for="inputTransactionPurpose">Статья</label>
                                                        <select class="form-control"
                                                                name="transaction[transaction_purpose_id]"
                                                                id="transaction_purpose_id">
                                                            <option value="">Выберите...</option>
                                                            @foreach($purpose as $purposeItem)
                                                                <option value=" {{$purposeItem->id}}">{{$purposeItem->name}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputTransactionAmount">Сумма</label>
                                                        <input type="number" id="transaction-amount"
                                                               class="form-control" name="transaction[amount]"
                                                               style="font-size: 24px;" step="any" aria-required="true"
                                                               aria-invalid="true">

                                                    </div>


                                                </div>


                                                <div class="col-sm-12 col-md-6">

                                                    <div class="form-group">
                                                        <label for="inputStatus">Менеджер</label>
                                                        <select class="form-control" name="transaction[admin]"
                                                                id="transaction-status">

                                                            <option value="">Выберите...</option>
                                                            @foreach($usersAdmin as $userAdmin)
                                                                 <option value="{{$userAdmin->id}}" @if(Auth::guard('admin')->id() == $userAdmin->id) selected @endif >@if(empty($userAdmin->lastname) && empty($userAdmin->firstname))
                                                                        (не задано) @else
                                                                        {{$userAdmin->lastname}} {{$userAdmin->firstname}} @endif</option>
                                                            @endforeach
                                                        </select>

                                                    </div>


                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- /.col -->


                        <div class="text-right card-footer">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputTransactionDescription">Комментарий</label>
                                <textarea id="transaction-description" class="form-control"
                                          name="transaction[description]" rows="5" aria-invalid="false"></textarea>
                            </div>
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



            $(document).on('change', '#user_id', function (e) {
                var selector = $(this);
                $('#account_id option').remove();
                $('#account_id').append('<option value="">Выберите...</option>');
                $.ajax({
                    url: '/admin/account-transaction/get-user-id/' + selector.val(),
                    type: "GET",
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (json) {
                        console.log(json);
                        json.forEach(function (user, key) {


                            $('#account_id').append('<option value="' + user["id"] + '"> ' + user["number"] + '</option>');


                        })
                    }
                });
            });



            varCount = 0;


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


            // Удалить нажатие кнопки
            $('form').on('click', '.removeVar', function () {
                console.log(this.id);
                $('#invoiceService-' + this.id + '').remove();

                varCount--;
            });


        });


    </script>

@endsection
