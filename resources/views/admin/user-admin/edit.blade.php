@extends('layouts.admin')

@section('css')

    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
@endsection

@section('title')
    Редактировать пользователя
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

                        <form id="w0" action="{{route('admin.userAdmin-update', $user['id'])}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="row">

                                <div class="col-sm-12 col-md-12">

                                    <div class="form-group">
                                        <label class="form-label" for="user-firstname">Имя</label>
                                        <input type="text" id="user-firstname" class="form-control" name="UserAdmin[firstname]" value="{{$user['firstname']}}">

                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="user-lastname">Фамилия</label>
                                        <input type="text" id="user-lastname" class="form-control" name="UserAdmin[lastname]" value="{{$user['lastname']}}">

                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="user-phone">Телефон</label>
                                        <input type="text" id="user-phone" class="form-control" name="UserAdmin[phone]" value="{{$user['phone']}}">

                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="user-role">Роль</label>
                                        <select id="user-role" class="form-control" name="UserAdmin[role]"
                                                aria-invalid="false">
                                            <option value="director" @if($user->hasRole('director')) selected @endif>Директор</option>
                                            <option value="manager" @if($user->hasRole('manager')) selected @endif>Управляющий</option>
                                            <option value="accountant" @if($user->hasRole('accountant')) selected @endif>Бухгалтер</option>
                                            <option value="electric" @if($user->hasRole('electric')) selected @endif>Электрик</option>
                                            <option value="plumber" @if($user->hasRole('plumber')) selected @endif>Сантехник</option>
                                        </select>


                                    </div>
                                    <div class="form-group ">
                                        <label class="form-label" for="status">Статус</label>
                                        <select id="status" class="form-control"
                                                name="UserAdmin[status]">
                                            <option value="10">Активен</option>
                                            <option value="5" selected="">Новый</option>
                                            <option value="0">Отключен</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="user-email">Email (логин)</label>
                                        <input type="text" id="user-email" class="form-control" name="email" value="{{$user['email']}}">

                                    </div>

                                    <div class="form-group">

                                        <label class="form-label" for="user-password">Пароль</label>

                                        <div class="input-group">
                                            <input type="password" id="user-password"
                                                   class="form-control pass-value user-password"
                                                   name="UserAdmin[password]" maxlength="255">

                                            <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"
                                                onclick="generatePassword('.pass-value')">
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
                                        <input type="password" id="user-password2"
                                               class="form-control pass-value user-password2"
                                               name="UserAdmin[password2]" maxlength="255">

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


        window.addEventListener("load", function () {

            // icono para mostrar contraseña
            showPassword = document.querySelector('.showPass');
            showPassword.addEventListener('click', () => {

                // elementos input de tipo clave
                password1 = document.querySelector('.user-password');
                password2 = document.querySelector('.user-password2');

                if (password1.type === "text") {
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
