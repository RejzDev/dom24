@extends('layouts.admin')

@section('css')

    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
@endsection

@section('title')

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


                    <div class="card-body">

                        <form id="w0" action="{{route('saveUser')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class=" row">
                                        <div class="form-group col">
                                        <img class="img-circle pull-left img-rounded"
                                             src="{{asset('image/logo-mini.svg')}}">
                                        </div>
                                        <div class="form-group col">
                                            <label class="form-label" for="user-image">Сменить изображение</label>
                                            <input type="hidden" name="imageId" value="">
                                            <input type="file" id="user-image" class="form-row" name="image">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="user-status">Статус</label>
                                        <select id="user-status" class="form-control" name="status">
                                            <option value="1">Активен</option>
                                            <option value="2" selected="">Новый</option>
                                            <option value="0">Отключен</option>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="user-uid">ID</label>
                                        <input type="text" id="user-uid" class="form-control" name="uid">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="user-lastname">Фамилия</label>
                                        <input type="text" id="user-lastname" class="form-control" name="lastname">

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="user-firstname">Имя</label>
                                        <input type="text" id="user-firstname" class="form-control" name="firstname">

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="user-middlename">Отчество</label>
                                        <input type="text" id="user-middlename" class="form-control" name="middlename">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="user-birthdate">Дата рождения</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="birthdate">
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group field-user-note">
                                        <label class="form-label" for="user-note">О владельце (заметки)</label>
                                        <textarea id="user-note" class="form-control" name="note" rows="10"
                                                  style="height: 256px"></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <h2 class="card-header">Контактные данные</h2>
                                    <div class="form-group">
                                        <label class="form-label" for="user-phone">Телефон</label>
                                        <input type="text" id="user-phone" class="form-control" name="phone">

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="user-viber">Viber</label>
                                        <input type="text" id="user-viber" class="form-control" name="viber">


                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="user-telegram">Telegram</label>
                                        <input type="text" id="user-telegram" class="form-control" name="telegram">

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="user-email">Email (логин)</label>
                                        <input type="text" id="user-email" class="form-control" name="email">

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <h2 class="card-header">Изменить пароль</h2>
                                    <div class="form-group">
                                        <label class="form-label" for="user-password">Пароль</label>

                                        <div class="input-group">
                                            <input type="password" id="user-password" class="form-control pass-value user-password"
                                                   name="password" maxlength="255">

                                            <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" onclick="generatePassword('.pass-value')">
                                          Сгенерировать
                                      </button>
                                         <button type="button" class="btn btn-primary showPass" id="showPass">
                                           <i class="fa fa-eye" aria-hidden="true"></i>
                                         </button>
                                         </span>

                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="user-password2">Повторить пароль</label>
                                        <input type="password" id="user-password2" class="form-control pass-value user-password2"
                                               name="password2" maxlength="255">

                                    </div>
                                </div>
                            </div>


                            <div class="text-right card-footer">
                                <a href="" class="btn btn-default">Отменить</a>
                                <button type="submit" class="btn btn-success">Сохранить</button>
                            </div>

                        </form>

                    </div>

                </div>
                </div>

            </div>

        </div>
        @endsection

        @section('js')
            <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

            <script>
                $('#reservationdate').datetimepicker({
                    format: 'L'
                });
                function generatePassword(targetSelector) {
                    var pass = Math.random().toString(36).substring(4);
                    $('input' + targetSelector).val(pass);
                    $('span' + targetSelector).text(pass);
                }


                window.addEventListener("load", function() {

                    // icono para mostrar contraseña
                    showPassword = document.querySelector('.showPass');
                    showPassword.addEventListener('click', () => {

                        // elementos input de tipo clave
                        password1 = document.querySelector('.user-password');
                        password2 = document.querySelector('.user-password2');

                        if ( password1.type === "text" ) {
                            password1.type = "password"
                            password2.type = "password"
                            $(showPassword).children().removeClass('fa-eye-slash').addClass('fa-eye');
                        } else {
                            password1.type = "text"
                            password2.type = "text"
                            $(showPassword).children().removeClass('fa-eye').addClass('fa-eye-slash');
                        }

                    })

                });



            </script>

@endsection
