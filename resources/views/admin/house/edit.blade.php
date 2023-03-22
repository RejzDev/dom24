@extends('layouts.admin')

@section('css')


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


                    <div class="card-header">
                        <h1 class="card-title">Новый дом</h1>

                    </div>


                    <!-- form start -->
                    <form action="{{route('adminHouseUpdate', $house['id'])}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}


                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">

                                    <!-- Profile Image -->

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputSeoTitle">Название</label>
                                            <input type="text" class="form-control" name="name"
                                                   id="inputName" value="{{$house['house_name']}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSeoTitle">Адрес</label>
                                            <input type="text" class="form-control" name="addressHouse"
                                                   id="inputAddressHouse" value="{{$house['house_address']}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="houseImage1">Изображение #1. Размер: (522x350)</label>
                                            <input type="file"  name="houseImage[]" id="house-image1" accept="image/*">
                                            <input type="hidden"  name="pathHouseImage[]" id="house-image1" value="{{$house['image1']}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="houseImage2">Изображение #2. Размер: (248x160)</label>
                                            <input type="file"  name="houseImage[]" id="house-image2" accept="image/*">
                                            <input type="hidden"  name="pathHouseImage[]" id="house-image1" value="{{$house['image2']}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="houseImage3">Изображение #3. РРазмер: (248x160)</label>
                                            <input type="file"  name="houseImage[]" id="house-image3" accept="image/*">
                                            <input type="hidden"  name="pathHouseImage[]" id="house-image1" value="{{$house['image3']}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="houseImage4">Изображение #4. Размер: (248x160)</label>
                                            <input type="file"  name="houseImage[]" id="house-image4" accept="image/*">
                                            <input type="hidden"  name="pathHouseImage[]" id="house-image1" value="{{$house['image4']}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="houseImage5">Изображение #5. Размер: (248x160)</label>
                                            <input type="file"  name="houseImage[]" id="house-image5" accept="image/*">
                                            <input type="hidden"  name="pathHouseImage[]" id="house-image1" value="{{$house['image5']}}">
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

                                                @foreach($house['sections'] as $section)
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="nameSection[]" value="{{$section['name']}}">
                                                    <input type="hidden" class="form-control" name="idSection[]" value="{{$section['id']}}">
                                                    <span class="input-group-append removeVar">
                    <a onclick="deletesSection({{$section['id']}}); return false;" class="btn btn-info btn-danger"><i class="fa fa-trash"></i></a>
                  </span>
                                                </div>

                                                @endforeach
                                                <div class="btn-group float-right">
                                                    <button type="button" class="btn btn-success" id="houseSection">
                                                        Добавить
                                                    </button>
                                                </div>


                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                                 aria-labelledby="custom-tabs-four-profile-tab">

                                                @foreach($house['flours'] as $flour)
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="nameFlour[]" value="{{$flour['name']}}">
                                                    <input type="hidden" class="form-control" name="idFlour[]" value="{{$flour['id']}}">
                                                    <span class="input-group-append removeVar">

                    <a onclick="deletesFlour({{$flour['id']}}); return false;" class="btn btn-info btn-danger"><i class="fa fa-trash"></i></a>
                  </span>
                                                </div>
                                                @endforeach
                                                <div class="btn-group float-right">
                                                    <button type="button" class="btn btn-success" id="houseFlours">
                                                        Добавить
                                                    </button>
                                                </div>


                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                                 aria-labelledby="custom-tabs-four-messages-tab">

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


                function deletesFlour(id)
                {

                    $.ajax({
                        type: 'GET',
                        url: '/admin-panel/house-flour-remove/' + id ,
                        headers: {
                            'X-CSRF-Token': '{{csrf_token()}}'
                        },
                        dataType : 'json',
                        success: (data) => {
                            console.log(data)

                        },
                        error: (data) => {
                            console.log(data)
                        }
                    });
                }

                function deletesSection(id)
                {

                    $.ajax({
                        type: 'GET',
                        url: '/admin-panel/house-section-remove/' + id ,
                        headers: {
                            'X-CSRF-Token': '{{csrf_token()}}'
                        },
                        dataType : 'json',
                        success: (data) => {
                            console.log(data)

                        },
                        error: (data) => {
                            console.log(data)
                        }
                    });
                }
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
