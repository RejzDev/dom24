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
                <div class="card">


                    <div class="card-header">
                        <h3 class="card-title">Редактирование страницы "Главная"</h3>
                        <div class="card-tools">
                            <a href="/admin/website/update-seo-files" class="btn btn-default btn-sm updateSeoFiles">
                                <span class="hidden-xl">Обновить robots и sitemap</span><i class="fa fa-refresh visible-xs" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>





                        <!-- form start -->
                    <form action="{{route('saveWebsiteMain')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}



                    <div class="card-body">

                        <div class="card-header">
                            <h3 class="card-header">Слайдер</h3>
                        </div>


                    <div class="row col-12 col-sm-12 col-md-12">

                        @if(count($slide) != 0)
                        @foreach($slide as $item)
                                <div class="col-sm-12  col-md-12 col-lg-4">
                            <div class="card shadow-sm">
                                <img src="{{asset('/storage/' . $item['image'])}}" class="card-img" width="100%" height="300" />
                                <input type="hidden" name="idSlide[]" value="{{$item['id']}}">
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="pathImage[]" value="{{$item['image']}}">
                                <input type="file" class="form" name="slide[]">
                            </div>

                        </div>
                        @endforeach
                        @if(count($slide) < 3)
                            @for($i = 1,$iMax = 3 - count($slide); $i <= $iMax; $i++)
                                    <div class="col-sm-12  col-md-12 col-lg-4">
                                    <div class="card shadow-sm">
                                        <img src="{{asset('image/glide.jpeg')}}" class="card-img" width="100%" height="300" />
                                        <input type="hidden" name="idSlide[]" value="">
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="pathImage[]" value="">
                                        <input type="file" class="form" name="slide[]">
                                    </div>

                                </div>
                            @endfor
                        @endif
                        @else
                            @for($i = 1; $i < 4; $i++)
                                <div class="col-sm-12  col-md-12 col-lg-4">
                                    <div class="card shadow-sm">
                                        <img src="{{asset('image/glide.jpeg')}}" class="card-img" width="100%" height="300" />
                                        <input type="hidden" name="idSlide[]" value="">
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="pathImage[]" value="">
                                        <input type="file" class="form" name="slide[]">
                                    </div>

                                </div>
                            @endfor
                        @endif
                    </div>
                    </div>

                    <div class="card-body">
                        <h3 class="card-header">Краткая информация</h3>
                    </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputTitle">Заголовок</label>
                                <input type="text" class="form-control" name="websiteTitle" id="inputTitle" value="@if(!empty($website[0])) {{$website[0]['title']}} @endif">
                                <input type="hidden" name="websiteId" value="@if(!empty($website[0])) {{$website[0]['id']}} @endif">
                            </div>

                            <div class="form-group">
                                <label for="inputDescription">Краткий текст</label>
                                <textarea id="summernote" name="DescriptionText" class="summernote">@if(!empty($website[0])) {{$website[0]['description']}} @endif</textarea>

                            </div>


                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="url_application" id="exampleCheck1" @if(!empty($website[0]) && $website[0]['url_application'] == 1) checked @endif>
                                <label class="form-check-label" for="exampleCheck1" >Показать ссылки на приложения</label>
                            </div>
                        </div>


                        <div class="card-body">
                            <h3 class="card-header">Рядом с нами</h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <div class="row col-12 col-sm-12 col-lg-12 col-md-12">


                                    @if(count($conditions) != 0)
                                        @foreach($conditions as $item)
                                            <div class="col-sm-12  col-md-12 col-lg-4">
                                                <h5>Блок {{$loop->iteration}}</h5>
                                        <div class="card shadow-sm">
                                            <img src="{{asset('/storage/' . $item['image'])}}" class="card-img" width="100%" height="300" />
                                            <input type="hidden" name="idConditions[]" value="{{$item['id']}}">
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="pathConditionsImage[]" value="{{$item['image']}}">
                                            <input type="file" class="form" name="conditions[]">
                                        </div>


                                        <div class="form-group">
                                            <label for="inputTitle">Заголовок</label>
                                            <input type="text" class="form-control" name="conditionsTitle[]" id="inputTitle" value="{{$item['title']}}">

                                        </div>

                                        <div class="form-group">
                                            <label for="inputDescription">Краткий текст</label>
                                            <textarea id="summernote" name="smallText[]" class="summernote">{{$item['description']}}</textarea>
                                        </div>

                                    </div>
                                        @endforeach
                                        @if(count($conditions) < 6)
                                            @for($i = 1,$iMax = 6 - count($conditions); $i <= $iMax; $i++)

                                                    <div class="col-sm-12  col-md-12 col-lg-4">

                                                        <h5>Блок {{$iMax + $i}}</h5>
                                                        <div class="card shadow-sm">
                                                            <img src="{{asset('image/glide.jpeg')}}" class="card-img" width="100%" height="300" />
                                                            <input type="hidden" name="idConditions[]" value="">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="hidden" name="pathConditionsImage[]" value="image/Kti5oj2CB4esqqzDl0uemrVuT0G7BE99N6stqjyd.jpg">
                                                            <input type="file" class="form" name="conditions[]">
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="inputTitle">Заголовок</label>
                                                            <input type="text" class="form-control" name="conditionsTitle[]" id="inputTitle">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="inputDescription">Краткий текст</label>
                                                            <textarea id="summernote" name="smallText[]" class="summernote"></textarea>
                                                        </div>

                                                    </div>


                                                @endfor
                                            @endif
                                    @else
                                        @for($i = 0; $i < 6; $i++)

                                            <div class="col-sm-12  col-md-12 col-lg-4">

                                                <h5>Блок {{$i}}</h5>
                                                <div class="card shadow-sm">
                                                    <img src="{{asset('image/glide.jpeg')}}" class="card-img" width="100%" height="300" />
                                                    <input type="hidden" name="idConditions[]" value="">
                                                </div>

                                                <div class="form-group">
                                                    <input type="hidden" name="pathConditionsImage[]" value="image/Kti5oj2CB4esqqzDl0uemrVuT0G7BE99N6stqjyd.jpg">
                                                    <input type="file" class="form" name="conditions[]">
                                                </div>


                                                <div class="form-group">
                                                    <label for="inputTitle">Заголовок</label>
                                                    <input type="text" class="form-control" name="conditionsTitle[]" id="inputTitle">
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputDescription">Краткий текст</label>
                                                    <textarea id="summernote" name="smallText[]" class="summernote"></textarea>
                                                </div>

                                            </div>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="card-body">
                            <h3 class="card-header">Настройки  SEO</h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputSeoTitle">Title</label>
                                <input type="text" class="form-control" name="seoTitle" id="inputSeoTitle" value="@if(!empty($website[0])) {{$website[0]['seo_title']}} @endif">
                            </div>

                            <div class="form-group">
                                <label for="inputSeoDescription">Description</label>
                                <textarea class="form-control" r name="seoDescription"  id="inputSeoDescription" rows="6">@if(!empty($website[0])) {{$website[0]['seo_description']}} @endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputSeoKeywords">Keywords</label>
                                <textarea class="form-control" name="seoKeywords" id="inputSeoKeywords" rows="6">@if(!empty($website[0])) {{$website[0]['seo_keywords']}} @endif</textarea>
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
                height:150,
                minHeight:100,
                maxHeight:200,
                focus:false,
                toolbar:[
                    ['style'],
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],


                ]
            });

    </script>
@endsection
