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
                    <form action="{{route('saveWebsiteAbout')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}


                        <div class="card-body">
                            <h3 class="card-header">Информация</h3>
                        </div>


                        <div class="card-body">
                            <div class="row col-xl-12">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="inputTitle">Заголовок</label>
                                        <input type="text" class="form-control" name="websiteAboutTitle" id="inputTitle"
                                               value="@if(!empty($website[0])) {{$website[0]['title']}} @endif">
                                        <input type="hidden" name="websiteAboutId"
                                               value="@if(!empty($website[0])) {{$website[0]['id']}} @endif">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">Краткий текст</label>
                                        <textarea id="summernote" name="AboutDescriptionText"
                                                  class="summernote">@if(!empty($website[0])) {{$website[0]['description']}} @endif</textarea>

                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <h4>Фото директора</h4>
                                    @if(!empty($website[0]['image']))
                                        <img src="{{asset('/storage/' . $website[0]['image'])}}" alt=""
                                             style="width: 250px; height: 300px">
                                        <div class="form-group">
                                            <label for="websiteAboutImage">Рекомендуемый размер: (250x310)</label>
                                            <input type="file" class="form col" name="websiteAboutImage">
                                            <input type="hidden" name="pathWebsiteAboutImage"
                                                   value="@if(!empty($website[0])) {{$website[0]['image']}} @endif">

                                        </div>
                                    @else
                                        <img src="{{asset('image/glide.jpeg')}}" alt=""
                                             style="width: 250px; height: 300px">
                                        <div class="form-group">
                                            <label for="websiteAboutImage">Рекомендуемый размер: (250x310)</label>
                                            <input type="file" class="form col" name="websiteAboutImage">
                                            <input type="hidden" name="pathWebsiteAboutImage"
                                                   value="@if(!empty($website[0])) {{$website[0]['dop_description']}} @endif">

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <h3 class="card-header">Фотогалерея</h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <div class="row col-12 col-sm-12 col-lg-12 col-md-12">
                                    @if(!empty($aboutGallery))
                                        @foreach($aboutGallery as $item)
                                            <div class="col-4 col-sm-4 col-md-3 col-lg-3 col-xl-3">
                                                <div class="card-body">
                                                    <img src="{{asset('/storage/' . $item['image'])}}" alt=""
                                                         class="img-thumbnail">
                                                </div>
                                                <div class="card-img text-center">
                                                    <a href="{{route('removeImageGallery', $item['id'])}}" title="Удалить"><i
                                                            class="text-center fa fa-trash text-red"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="websiteAboutImage">Рекомендуемый размер: (1200x1200)</label>
                                            <input type="file" class="form col text-center"
                                                   name="websiteAboutGallery[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <h3 class="card-header">Дополнительная информация</h3>
                        </div>


                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputTitle">Заголовок</label>
                                        <input type="text" class="form-control" name="websiteAboutDopTitle"
                                               id="inputTitle"
                                               value="@if(!empty($website[0])) {{$website[0]['dop_title']}} @endif">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">Краткий текст</label>
                                        <textarea id="summernote" name="websiteAboutDopDescriptionText"
                                                  class="summernote">@if(!empty($website[0])) {{$website[0]['dop_description']}} @endif</textarea>

                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <h3 class="card-header">Дополнительная фотоналерея</h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <div class="row col-12 col-sm-12 col-md-12 col-lg-12">
                                    @if(!empty($aboutDopGallery))
                                        @foreach($aboutDopGallery as $dopGallery)
                                            <div class="col-4 col-sm-4 col-md-3 col-lg-3 col-xl-3">
                                                <div class="card-body">
                                                    <img src="{{asset('/storage/' . $dopGallery['image'])}}" alt=""
                                                         class="img-thumbnail">
                                                </div>
                                                <div class="card-img text-center">
                                                    <a href="{{route('removeImageGallery', $dopGallery['id'])}}" title="Удалить"><i
                                                            class="text-center fa fa-trash text-red"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="websiteAboutImage">Рекомендуемый размер: (1200x1200)</label>
                                            <input type="file" class="form col text-center"
                                                   name="websiteAboutGallery[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <h3 class="card-header">Документы</h3>
                        </div>

                        <div class="col-sm-12 col-xs-12 col-md-12">
                            <div id="websiteDocument" class="form-group card-body">

                                @if(!empty($aboutDocument))
                                    @foreach($aboutDocument as $document)
                                <div class="form-group">
                                    <div class="row">
                                        <i class="fa fa-file fa-3x " style="width: 32px;" aria-hidden="true"></i>

                                        <div class="col-sm-10 col-md-10">
                                            <label for="websiteDocumentFile" class="card-title">Документ {{$document['title']}}</label>
                                                <a href="{{route('removeDocument', $document['id'])}}" class="pull-right text-red"><i class="fa fa-trash"></i></a>
                                        </div>
                                        <div class="col-md-10">
                                            <a href="{{route('downloadDocument', $document['id'])}}" ><i class="fa fa-download"></i> Скачать</a>
                                        </div>
                                    </div>
                                </div>
                                    @endforeach
                                    @endif
                            </div>




                <div class="btn-group">
                    <button type="button" class="btn btn-success" id="websiteDocumentAdd">
                        Добавить документ
                    </button>
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
                </div>

                <div class="form-group">
                    <label for="inputSeoDescription">Description</label>
                    <textarea class="form-control" r name="seoDescription" id="inputSeoDescription"
                              rows="6">@if(!empty($website[0])) {{$website[0]['seo_description']}} @endif</textarea>
                </div>

                <div class="form-group">
                    <label for="inputSeoKeywords">Keywords</label>
                    <textarea class="form-control" name="seoKeywords" id="inputSeoKeywords"
                              rows="6">@if(!empty($website[0])) {{$website[0]['seo_keywords']}} @endif</textarea>
                </div>


            </div>


            <div class="text-center card-footer">
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

        // Количество начальных параметров
        var varCount = 0;

        $(function () {
            // Новое нажатие кнопки+
            $('#websiteDocumentAdd').on('click', function () {
                varCount++;
                $node = '<div class="row">'
                    + '<div id="websiteDocument-' + varCount + '" class="form-group col-md-10">'
                    + '<div class="form-group">'
                    + '<label for="websiteDocumentFile-' + varCount + '">PDF, JPG (макс. размер 20 Mb)</label>'
                    + ' <input type="file" class="form col text-center" name="websiteAboutDocument[]">'
                    + '</div>'
                    + ' <div class="form-group">'
                    + ' <label for="websiteDocumentTitle-' + varCount + '">Название документа</label>'
                    + '  <input type="text" class="form-control" name="websiteDocumentTitle[]" id="websiteDocumentTitle">'
                    + '</div>'
                    + '</div>'
                    + '<a href="#!" class="text-red removeVar"><i class="fa fa-trash"></i></a>'
                    + '</div>'
                ;
                // Новый элемент формы добавляется перед кнопкой "новая"
                $(this).parent().before($node);
            });
            // Удалить нажатие кнопки
            $('form').on('click', '.removeVar', function () {
                $(this).parent().remove();
                //varCount--;
            });
        });

    </script>
@endsection
