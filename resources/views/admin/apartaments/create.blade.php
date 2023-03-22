@extends('layouts.admin')

@section('css')

    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">
@endsection

@section('title')
    Новая квартира
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
                    <form action="{{route('saveApartaments')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}


                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">

                                    <!-- Profile Image -->

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputNumber">Номер квартиры</label>
                                            <input type="text" class="form-control" name="numberApartaments"
                                                   id="inputNumberApartaments">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSSquare">Площадь (кв.м.)</label>
                                            <input type="text" class="form-control" name="squareApartaments"
                                                   id="inputsquareApartaments">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputHouse">Дом</label>
                                                <select class="form-control" name="house"  id="house-list">
                                                    <option value="">Выберите...</option>
                                                    @foreach($houses as $house)
                                                        <option value="{{$house['id']}}">{{$house['house_name']}}</option>
                                                    @endforeach
                                                </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputHouse">Секция</label>
                                            <select class="form-control" name="section"  id="section-list">
                                                <option value="">Выберите...</option>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputHouse">Этаж</label>
                                            <select class="form-control" name="flours"  id="flours-list">
                                                <option value="">Выберите...</option>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputHouse">Владелец</label>
                                            <select class="form-control" name="owner"   id="owner-list">
                                                <option value="">Выберите...</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user['id']}}">{{$user['lastname']}} {{$user['firstname']}} {{$user['middlename']}} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputHouse">Тариф</label>
                                            <select class="form-control" name="tariff"  id="tariff-list">
                                                <option value="">Выберите...</option>
                                                @foreach($tariffs as $tariff)
                                                    <option value="{{$tariff['id']}}">{{$tariff['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>
                                    <!-- /.card-body -->

                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="card-body">


                                            <div class="form-group">
                                                <label for="inputHouse">Лицевой счет</label>
                                                <input type="text" class="form-control" name="numberPersonalAccount"
                                                       id="inputNumberPersonalAccount">

                                                <select class="form-control" name="personalAccount"  id="personalAccount-list" >
                                                    <option></option>
                                                    @foreach($accounts as $account)
                                                        <option value="{{$account['number']}}">{{$account['number']}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>


                        </div>




                        <div class="text-center card-footer">
                            <a href="{{route('adminApartamentsIndex')}}" class="btn btn-default">Отменить</a>
                            <button type="submit" class="btn btn-success">Сохранить</button>
                            <a href="{{route('adminApartamentsCreate')}}" class="btn btn-success">Сохранить и добавить новую</a>

                        </div>
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

                $("#personalAccount-list").select2({
                    placeholder: "или выберите из списка...",
                });

                $('#personalAccount-list').on('select2:select', function (e) {
                    $('input[name="numberPersonalAccount"]').val($(this).val());
                    $("#personalAccount-list").val(null).trigger('change');

                });



                $("#house-list").change(function(){


                    $('#section-list').find('option').remove();
                    $('#section-list').append('<option value="">Выберите...</option>');

                    $('#flours-list').find('option').remove();
                    $('#flours-list').append('<option value="">Выберите...</option>');

                    $.ajax({
                        type: 'POST',
                        url: '{{route('adminApartamentsHouse')}}',
                        headers: {
                            'X-CSRF-Token': '{{csrf_token()}}'
                        },
                        data: {
                            name: $(this).val()
                        },
                        success: function (data) {
                            for (var i in data['sections']) {
                                $('#section-list').append('<option value="' + data['sections'][i]['id'] + '">' + data['sections'][i]['name'] +'</option>');
                            }
                            for (var i in data['flours']) {
                                $('#flours-list').append('<option value="' + data['flours'][i]['id'] + '">' + data['flours'][i]['name'] +'</option>');
                            }
                                  },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });








            </script>


@endsection
