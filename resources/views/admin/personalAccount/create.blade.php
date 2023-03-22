@extends('layouts.admin')

@section('css')

    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">
@endsection

@section('title')
    Новый лицевой счет
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
                <form action=" @if(isset($personalAccount)){{route('personalAccount.update', $personalAccount['id'])}}@else{{route('personalAccount.store')}}@endif " method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @if(isset($personalAccount)) @method('PUT') @endif
                    <div class="form-group">
                        <div class="input-group col-sm-12 col-md-7 col-lg-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">№</span>
                            </div>
                            <input type="text" id="account-number" class="form-control" name="account[number]"
                                   value="@if(isset($personalAccount['number'])){{$personalAccount['number']}}@endif"
                                   aria-required="true">
                            <input type="hidden" id="account-id" class="form-control" name="account[accountId]"
                                   value="@if(isset($personalAccount)){{$personalAccount['id']}}@endif"
                                   aria-required="true">
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
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label for="inputName">Статус</label>
                                                        <select class="form-control" name="account[status]"
                                                                id="account-status">
                                                            <option value="1"
                                                                    @if(isset($personalAccount) && $personalAccount['status'] == 1) selected @endif>
                                                                Активен
                                                            </option>
                                                            <option value="0"
                                                                    @if(isset($personalAccount) && $personalAccount['status'] == 0) selected @endif>
                                                                Неактивен
                                                            </option>
                                                        </select>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputName">Дом</label>
                                                        <select class="form-control" name="house_id" id="house_id">
                                                            <option value="">Выберите...</option>

                                                            @foreach($houses as $house)
                                                                <option
                                                                    value="{{$house['id']}}"
                                                                    @if(isset($personalAccount->apartaments->houses) && $house['id'] == $personalAccount->apartaments->houses['id']) selected @endif>{{$house['house_name']}}</option>
                                                            @endforeach

                                                        </select>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputName">Секция</label>
                                                        <select class="form-control" name="section_id" id="section_id">
                                                            <option value="">Выберите...</option>

                                                            @if(isset($personalAccount->apartaments))

                                                                @foreach($personalAccount->apartaments->houses['sections'] as $sections)
                                                                    <option
                                                                        value="{{$sections['id']}}"
                                                                        @if($personalAccount->apartaments->sections['id'] == $sections['id']) selected @endif>{{$sections['name']}}</option>
                                                                @endforeach

                                                            @endif
                                                        </select>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputName">Квартира</label>
                                                        <select class="form-control" name="account[apartments_id]"
                                                                id="account-apartments">
                                                            <option value="">Выберите...</option>
                                                            @if(isset($personalAccount->apartaments))


                                                                @foreach($personalAccount->apartaments->sections['apartaments'] as $apartments)
                                                                    <option
                                                                        value="{{$apartments['id']}}"
                                                                        @if($personalAccount->apartaments['id'] == $apartments['id']) selected @endif>{{$apartments['number']}}</option>
                                                                @endforeach

                                                            @endif
                                                        </select>
                                                    </div>

                                                    <p><b>Владелец:</b> <span id="user-fullname">
                                                            @if(isset($personalAccount->apartaments->users))

                                                                {{$personalAccount->apartaments->users['lastname']}}  {{$personalAccount->apartaments->users['firstname']}} {{$personalAccount->apartaments->users['middlename']}}

                                                            @else
                                                                не выбран
                                                            @endif
                                                        </span></p>
                                                    <p><b>Телефон:</b> <span id="user-phone">
                                                            @if(isset($personalAccount->apartaments->users))

                                                                {{$personalAccount->apartaments->users['phone']}}
                                                            @else
                                                                не выбран
                                                            @endif
                                                        </span></p>

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

    <script>


        jQuery(function ($) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')

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
                $('#account-apartments option').remove();
                $('#account-apartments').append('<option value="">Выберите...</option>');
                $.ajax({
                    url: '/admin-panel/get-section-id/' + selector.val(),
                    type: "GET",
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (json) {

                        json['apartaments'].forEach(function (apartments, key) {

                            $('#account-apartments').append('<option value="' + apartments["id"] + '"> ' + apartments["number"] + '</option>');

                        })
                    }
                });
            });


            $(document).on('change', '#account-apartments', function (e) {
                var selector = $(this);

                $.ajax({
                    url: '/admin-panel/get-apartaments-id/' + selector.val(),
                    type: "GET",
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (json) {
                        $("#user-fullname").html(json['users']['lastname'] + ' ' + json['users']['firstname'] + ' ' + json['users']['middlename']);

                        $("#user-phone").html(json['users']['phone']);

                    }
                });
            });


        });


    </script>

@endsection
