@extends('layouts.website')

@section('seoDescription')
    {{$website[0]['seo_description']}}
@endsection

@section('seoKeywords')
    {{$website[0]['seo_keywords']}}
@endsection

@section('title')
    {{$website[0]['seo_title']}}
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/gallery.css')}}">
@endsection

@section('content')


    <div class="container">
        <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="" class="text-decoration-none">Главная</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">О нас</li>
                </ol>
            </nav>
        </div>
        <div class="row g-5">
            <div class="col-xs-8 col-sm-12 col-md-12">
                <div class="card-body border-bottom">
                    <h1 class="display-6">{{$website[0]['title']}}</h1>
                </div>
                <div class="card-body g-5">

                    <img src="{{asset('/storage/' . $website[0]['image'])}}" class="img-right text-center" alt=""
                         style="width: 250px; height: 300px">

                    {!! $website[0]['description'] !!}


                </div>
            </div>

        </div>


        <div class="row col-12 col-sm-12 col-lg-12 col-md-12">
            <div class="card-body">
                <div class="fg-gallery">

                    @foreach($aboutGallery as $gallery)
                        <img src="{{asset('/storage/' . $gallery['image'])}}" alt="">
                    @endforeach
                </div>
            </div>

        </div>

        <div class="row g-5">
            <div class="col-xs-8 col-sm-12 col-md-12">
                <div class="card-body border-bottom">
                    <h1 class="display-6">{{$website[0]['dop_title']}}</h1>
                </div>
                <div class="card-body g-5">

                    {!! $website[0]['dop_description'] !!}


                </div>
            </div>

        </div>


        <div class="row col-12 col-sm-12 col-lg-12 col-md-12">
            <div class="card-body">
                <div class="fg-gallery ns">

                    @foreach($aboutDopGallery as $dopGallery)
                        <img src="{{asset('/storage/' . $dopGallery['image'])}}" alt="">
                    @endforeach
                </div>
            </div>

        </div>

        <div class="row g-5">
            <div class="col-xs-8 col-sm-12 col-md-12">
                <div class="card-body border-bottom">
                    <h1 class="display-6">Документы</h1>
                </div>

                    <div class="col-sm-12 col-xs-12 col-md-12">
                        <div id="websiteDocument" class="form-group card-body">

                            @if(!empty($aboutDocument))
                                @foreach($aboutDocument as $document)
                                    <div class="form-group">
                                        <div class="row">
                                            <i class="fa fa-file fa-3x " style="width: 32px; margin-right: 10px" aria-hidden="true"></i>

                                            <div class="col-sm-10 col-md-10">
                                                <label for="websiteDocumentFile" class="card-title">Документ {{$document['title']}}</label>
                                                   </div>
                                            <div class="col-md-10">
                                                <a href="{{route('downloadDocument', $document['id'])}}" ><i class="fa fa-download"></i> Скачать</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>



                    </div>

            </div>

        </div>


    </div>
@endsection


@section('js')
    <script src="{{asset('js/gallery.js') }}"></script>
    <script src="{{asset('js/jquery-3.6.0.min.js') }}"></script>

    <script>
        var myGallery = new FgGallery('.fg-gallery', {
            cols: 4,
            style: {
                border: '10px solid #fff',
                height: '290px',
                boxShadow: '0 2px 10px -5px #000'
            }
        });

        var myGallery = new FgGallery('.ns', {
            cols: 4,
            style: {
                border: '10px solid #fff',
                height: '290px',
                boxShadow: '0 2px 10px -5px #000'
            }
        })
    </script>
@endsection
