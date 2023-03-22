@extends('layouts.admin')

@section('css')


@endsection

@section('title')

@endsection




@section('content')



    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">


                    <div class="card-header">
                        <h1 class="card-title">Новый дом</h1>

                    </div>


                    <!-- form start -->
                    <form action="{{route('saveHouse')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}


                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">

                                    <!-- Profile Image -->

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputSeoTitle">Название</label>
                                            <input type="text" class="form-control" name="name"
                                                   id="inputName">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSeoTitle">Адрес</label>
                                            <input type="text" class="form-control" name="addressHouse"
                                                   id="inputAddressHouse">
                                        </div>

                                        <div class="form-group">
                                            <label for="houseImage1">Изображение #1. Размер: (522x350)</label>
                                            <input type="file"  name="houseImage[]" id="house-image1" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="houseImage2">Изображение #2. Размер: (248x160)</label>
                                            <input type="file"  name="houseImage[]" id="house-image2" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="houseImage3">Изображение #3. РРазмер: (248x160)</label>
                                            <input type="file"  name="houseImage[]" id="house-image3" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="houseImage4">Изображение #4. Размер: (248x160)</label>
                                            <input type="file"  name="houseImage[]" id="house-image4" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="houseImage5">Изображение #5. Размер: (248x160)</label>
                                            <input type="file"  name="houseImage[]" id="house-image5" accept="image/*">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-9">
                                    <div class="card-body">

                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-md-6 mb-3">
                                                <img class="img-fluid" src="../../dist/img/photo1.png"
                                                     alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-6">
                                                        <img class="img-fluid mb-3"
                                                             src="../../dist/img/photo2.png" alt="Photo">
                                                        <img class="img-fluid mb-3"
                                                             src="../../dist/img/photo3.jpg" alt="Photo">
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-6 col-md-6 ">
                                                        <img class="img-fluid mb-3"
                                                             src="../../dist/img/photo4.jpg" alt="Photo">
                                                        <img class="img-fluid mb-3"
                                                             src="../../dist/img/photo1.png" alt="Photo">
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="card card-primary card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-four-home-tab"
                                                   data-toggle="pill" href="#custom-tabs-four-home" role="tab"
                                                   aria-controls="custom-tabs-four-home" aria-selected="true">Секции</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                                   href="#custom-tabs-four-profile" role="tab"
                                                   aria-controls="custom-tabs-four-profile"
                                                   aria-selected="false">Этажи</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-messages-tab"
                                                   data-toggle="pill" href="#custom-tabs-four-messages" role="tab"
                                                   aria-controls="custom-tabs-four-messages" aria-selected="false">Пользователи</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                            <div class="tab-pane fade active show" id="custom-tabs-four-home"
                                                 role="tabpanel" aria-labelledby="custom-tabs-four-home-tab"
                                                 id="houseSectionId">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="nameSection[]">
                                                    <span class="input-group-append removeVar">
                    <button type="button" class="btn btn-info btn-danger"><i class="fa fa-trash"></i></button>
                  </span>
                                                </div>

                                                <div class="btn-group float-right">
                                                    <button type="button" class="btn btn-success" id="houseSection">
                                                        Добавить
                                                    </button>
                                                </div>


                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                                 aria-labelledby="custom-tabs-four-profile-tab">


                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="nameFlour[]">
                                                    <span class="input-group-append removeVar">
                    <button type="button" class="btn btn-info btn-danger"><i class="fa fa-trash"></i></button>
                  </span>
                                                </div>

                                                <div class="btn-group float-right">
                                                    <button type="button" class="btn btn-success" id="houseFlours">
                                                        Добавить
                                                    </button>
                                                </div>


                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                                 aria-labelledby="custom-tabs-four-messages-tab">



                                                <div class="btn-group float-right">
                                                    <button type="button" class="btn btn-success" id="houseUser">
                                                        Добавить
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="text-center card-footer">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                    </form>


                </div>

            </div>

        </div>
        @endsection

        @section('js')

            <script>
                // Количество начальных параметров
                var varCount = 0;


                $(function () {
                    // Новое нажатие кнопки+
                    $('#houseSection').on('click', function () {


                        $node = ' <div class="input-group mb-3" >'
                            + '   <input type="text" class="form-control" name="nameSection[]"> '
                            + '  <span class="input-group-append removeVar">'
                            + '<button type="button" class="btn btn-info btn-danger"><i class="fa fa-trash"></i></button>'
                            + '         </span>'
                            + '</div>'

                        ;

                        // Новый элемент формы добавляется перед кнопкой "новая"
                        $(this).parent().before($node);
                    });
                    // Удалить нажатие кнопки
                    $('form').on('click', '.removeVar', function () {
                        $(this).parent().remove();
                        varCount--;
                    });
                });
            </script>

            <script>

                var Count = 0;


                $(function () {

                    $('#houseFlours').on('click', function () {


                        $node = ' <div class="input-group mb-3" >'
                            + '   <input type="text" class="form-control" name="nameFlour[]"> '
                            + '  <span class="input-group-append removeVar">'
                            + '<button type="button" class="btn btn-info btn-danger"><i class="fa fa-trash"></i></button>'
                            + '         </span>'
                            + '</div>'

                        ;

                        // Новый элемент формы добавляется перед кнопкой "новая"
                        $(this).parent().before($node);
                    });
                    // Удалить нажатие кнопки
                    $('form').on('click', '.removeVar', function () {
                        $(this).parent().remove();
                        Count--;
                    });
                });
            </script>

            <script>
                // Количество начальных параметров
                var varCount = 0;


                $(function () {
                    // Новое нажатие кнопки+
                    $('#houseUser').on('click', function () {


                        $node =  '<div id="form-houseUser" class="row" >'+
                            '<div class="col-xs-10 col-sm-5" >'+
                            '   <input type="hidden" id="houseUser-0" name="houseUser[][id]">'+
                            '            <input type="hidden" id="houseUser-0" name="houseUser[][houseId]" value="0">'+
                            '          <div class="form-group" >'+
                            '  <label for="houseuseradmin-0-user_admin_id">ФИО</label>'+
                            ' <select id="houseUser-select" class="form-control" name="houseUser[]">'+
                            '<option value="">Выберите...</option>'+
                            @foreach($users as $user)
                            '  <option value=" {{$user->id}}">@if(empty($user->lastname) && empty($user->firstname))
                                (не задано) @else
                                {{$user->lastname}} {{$user->firstname}} @endif</option>'+
                            @endforeach
                            '   </select>        </div>'+
                            '  </div>'+
                            '<div class="col-xs-10 col-sm-5" >'+
                            '<div class="form-group" >'+
                            ' <label for="houseUser-0-role">Роль</label>'+
                            '<div class="input-group" >'+
                            ' <input type="text" class="form-control" id="houseUser-0-role" value="" readonly="">'
                            +
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            '<span class="input-group-append removeVar col-sm-2 p-3">'+
                            ' <button type="button" class="btn btn-info btn-danger"><i class="fa fa-trash"></i></button>'+
                            '</span>'+
                            '</div>'

                        ;

                        // Новый элемент формы добавляется перед кнопкой "новая"
                        $(this).parent().before($node);
                    });
                    // Удалить нажатие кнопки
                    $('form').on('click', '.removeVar', function () {
                        $(this).parent().remove();
                        varCount--;
                    });
                });
            </script>


@endsection
