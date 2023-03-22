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
                        <h3 class="card-title">Редактирование страницы "Контакти"</h3>
                        <div class="card-tools">
                            <a href="/admin/website/update-seo-files" class="btn btn-default btn-sm updateSeoFiles">
                                <span class="hidden-xl">Обновить robots и sitemap</span><i
                                    class="fa fa-refresh visible-xs" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>


                    <!-- form start -->
                    <form action="{{route('saveWebsiteContact')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}


                        <div class="card-body">
                            <div class="row col-xl-12">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <h3 class="card-header">Контактная информация</h3>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTitle">Заголовок</label>
                                        <input type="text" class="form-control" name="websiteContactTitle" id="inputTitle"
                                               value="@if(!empty($website[0])) {{$website[0]['title']}} @endif">
                                        <input type="hidden" name="websiteContactId"
                                               value="@if(!empty($website[0])) {{$website[0]['id']}} @endif">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">Краткий текст</label>
                                        <textarea id="summernote" name="websiteContactDescriptionText"
                                                  class="summernote">@if(!empty($website[0])) {{$website[0]['description']}} @endif</textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="inputTitle">Ссылка на коммерческий сайт</label>
                                        <input type="text" class="form-control" name="websiteContactSite"
                                               value="@if(!empty($website[0])) {{$website[0]['url_comersial_site']}} @endif">
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h3 class="card-header">Контакты</h3>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTitle">ФИО</label>
                                        <input type="text" class="form-control" name="websiteContactNameCompany"
                                               value="@if(!empty($website[0])) {{$website[0]['name_company']}} @endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTitle">Локация</label>
                                        <input type="text" class="form-control" name="websiteContactLocation"
                                               value="@if(!empty($website[0])) {{$website[0]['location']}} @endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTitle">Адрес</label>
                                        <input type="text" class="form-control" name="websiteContactAddress"
                                               value="@if(!empty($website[0])) {{$website[0]['address']}} @endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTitle">Телефон</label>
                                        <input type="text" class="form-control" name="websiteContactPhone"
                                               value="@if(!empty($website[0])) {{$website[0]['phone']}} @endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTitle">E-mail</label>
                                        <input type="text" class="form-control" name="websiteContactEmail"
                                               value="@if(!empty($website[0])) {{$website[0]['email']}} @endif">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <h3 class="card-header">Карта</h3>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                            <label for="inputSeoDescription">Код карты</label>
                            <textarea class="form-control" name="websiteContactCodeMap" id="inputContactCodeMap"
                                      rows="6">@if(!empty($website[0])) {{$website[0]['code_maps']}} @endif</textarea>
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
                                <textarea class="form-control" name="seoDescription" id="inputSeoDescription"
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
            height: 155,
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
