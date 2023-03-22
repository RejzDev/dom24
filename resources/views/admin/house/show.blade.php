@extends('layouts.admin')

@section('css')


@endsection

@section('title')
    {{$house['house_name']}}
@endsection




@section('content')



    <div class="content">


        <div class="row">

            <div class="col-xl-12">
                <div class="card">


                    <div class="card-header">
                        <div class="float-right">
                            <a href="{{route('adminHouseEdit', $house['id'])}}" class="btn btn-primary btn-sm">
                                <span>Редактировать дом</span><i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>


                    <!-- form start -->


                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-5 col-lg-4">


                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-sm-12 col-md-12 mb-3">

                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                <tr>
                                                    <td>Название</td>
                                                    <td> {{$house['house_name']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Адрес</td>
                                                    <td> {{$house['house_address']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Секций</td>
                                                    <td>{{count($house['sections'])}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Этажей</td>
                                                    <td>{{count($house['flours'])}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Пользователи</td>
                                                    <td>
                                                        <p class="no-margin"><strong>Нет:</strong></p>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>



                                </div>
                                </div>
                                </div>
                                <!-- /.card-body -->

                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-7 col-lg-8">
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6 mb-3">
                                            <img class="img-fluid" src="{{asset('/storage/' . $house['image1'])}}"
                                                 alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-12 col-md-6">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6">
                                                    <img class="img-fluid mb-3"
                                                         src="{{asset('/storage/' . $house['image2'])}}" alt="Photo">
                                                    <img class="img-fluid mb-3"
                                                         src="{{asset('/storage/' . $house['image3'])}}" alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-6 col-md-6 ">
                                                    <img class="img-fluid mb-3"
                                                         src="{{asset('/storage/' . $house['image4'])}}" alt="Photo">
                                                    <img class="img-fluid mb-3"
                                                         src="{{asset('/storage/' . $house['image5'])}}" alt="Photo">
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


                    </div>
                </div>
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
        // Количество начальных параметров
        var Count = 0;


        $(function () {
            // Новое нажатие кнопки+
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


@endsection
