@extends('layouts.admin')

@section('css')

    <!-- include libraries(jQuery, bootstrap) -->
    <!-- include summernote css/js -->
    <link href="{{asset('plugins/summernote/summernote-bs4.min.css')}}" rel="stylesheet">

@endsection

@section('title')
    {{$website[0]['seo_title']}}
@endsection




@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                        </div>
                    @endif
                <div class="card">


                    <div class="card-header">
                        <h3 class="card-title">Редактирование страницы "О нас"</h3>
                        <div class="card-tools">
                            <a href="/admin/website/update-seo-files" class="btn btn-default btn-sm updateSeoFiles">
                                <span class="hidden-xl">Обновить robots и sitemap</span><i
                                    class="fa fa-refresh visible-xs" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>


                    <!-- form start -->
                    <form action="{{route('saveWebsiteServices')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}


                        <div class="card-body">
                            <h3 class="card-header">Информация</h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <div class="row col-12 col-sm-12 col-lg-12 col-md-12" id="services">


                                    @if(!empty($websiteServices))
                                        @foreach($websiteServices as $item)
                                    <div class="col-sm-12  col-md-12 col-lg-4">
                                        <a href="{{route('removeServices', $item['id'])}}" class="text-red float-right"><i class="fa fa-trash"></i></a>
                                        <h5 class="">Услуга  {{$loop->iteration}} </h5>
                                        <div class="card shadow-sm">
                                            <img src="{{asset('/storage/' . $item['image'])}}" class="card-img" width="100%" height="300" />
                                            <input type="hidden" name="idWebsiteServices[]" value="{{$item['id']}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="websiteAboutImage">Рекомендуемый размер: (650x300)</label>
                                            <input type="hidden" name="pathWebsiteServicesImage[]" value="{{$item['image']}}">
                                            <input type="file" class="form" name="websiteServices[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputTitle">Название услуги</label>
                                            <input type="text" class="form-control" name="websiteServicesTitle[]" id="inputTitle" value="{{$item['name']}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDescription">Описание услуги</label>
                                            <textarea id="summernote" name="smallText[]" class="summernote">{{$item['description']}}</textarea>
                                        </div>
                                    </div>
                                        @endforeach
                                    @endif

                                </div>


                            </div>
                        </div>



            <div class="card-body">
                <h3 class="card-header">Настройки SEO</h3>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="inputSeoTitle">Title</label>
                    <input type="text" class="form-control" name="seoTitle" id="inputSeoTitle"
                           value="@if(!empty($website[0])) {{$website[0]['seo_title']}} @endif">
                    <input type="hidden" name="websiteServicesPageId" value="@if(!empty($website[0])) {{$website[0]['id']}} @endif">

                </div>

                <div class="form-group">
                    <label for="inputSeoDescription">Description</label>
                    <textarea class="form-control"  name="seoDescription" id="inputSeoDescription"
                              rows="6">@if(!empty($website[0])) {{$website[0]['seo_description']}} @endif</textarea>
                </div>

                <div class="form-group">
                    <label for="inputSeoKeywords">Keywords</label>
                    <textarea class="form-control" name="seoKeywords" id="inputSeoKeywords"
                              rows="6">@if(!empty($website[0])) {{$website[0]['seo_keywords']}} @endif</textarea>
                </div>


            </div>


            <div class="text-center card-footer">
                <button type="button" class="btn btn-success" id="websiteDocumentAdd">
                    Добавить услугу
                </button>
                <button type="submit" class="btn btn-success">Сохранить</button>

            </div>
            </form>
        </div>

    </div>

    </div>

    </div>
@endsection

@section('js')

    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('plugins/summernote/lang/summernote-ru-RU.js')}}"></script>

    <script>
        // Количество начальных параметров
        var varCount = {{count($websiteServices)}};



        $(function () {
            // Новое нажатие кнопки+
            $('#websiteDocumentAdd').on('click', function () {
                varCount++;



                $node = '<div class="col-sm-12  col-md-12 col-lg-4" id=>'
                    +' <a href="#!" class="text-red removeVar float-right"><i class="fa fa-trash"></i></a> '
                    + '<h5 class="">Услуга ' +varCount+ '</h5>'
                    + '<div class="card shadow-sm">'
                    + '<img src="{{asset('image/glide.jpeg')}}" class="card-img" width="100%" height="300" />'
                    + ' <input type="hidden" name="idWebsiteServices[]" value="">'
                    + '</div>'
                    + ' <div class="form-group">'
                    + ' <label for="websiteAboutImage">Рекомендуемый размер: (650x300)</label>'
                    + ' <input type="hidden" name="pathWebsiteServicesImage[]" value="image/Kti5oj2CB4esqqzDl0uemrVuT0G7BE99N6stqjyd.jpg">'
                    + '  <input type="file" class="form" name="websiteServices[]">'
                    + '</div>'
                    + '<div class="form-group">'
                    + '<label for="inputTitle">Название услуги</label>'
                    + '<input type="text" class="form-control" name="websiteServicesTitle[]" id="inputTitle">'
                    + '</div>'
                    + '<div class="form-group">'
                    + ' <label for="inputDescription">Описание услуги</label>'
                    + '<textarea id="summernote" name="smallText[]" class="summernote"></textarea>'
                    + '</div>'
                     + '</div>'
                ;
                // Новый элемент формы добавляется перед кнопкой "новая"
                $('#services').append($node);

                $('.summernote').summernote({

                    lang: 'ru-RU',
                    height: 150,
                    minHeight: 100,
                    maxHeight: 200,
                    focus: false,
                    toolbar: [
                        ['style'],
                        ['style', ['bold', 'italic', 'underline']],
                        ['para', ['ul', 'ol', 'paragraph']],


                    ]
                });

            });
            // Удалить нажатие кнопки
            $('form').on('click', '.removeVar', function () {
                $(this).parent().remove();
                varCount--;
            });
        });
    </script>

    <script>


        $('.summernote').summernote({

            lang: 'ru-RU',
            height: 150,
            minHeight: 100,
            maxHeight: 200,
            focus: false,
            toolbar: [
                ['style'],
                ['style', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol', 'paragraph']],


            ]
        });


    </script>


@endsection
