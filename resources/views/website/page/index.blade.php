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

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide"  data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($slide as $item)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$loop->index}}" class="@if($loop->iteration === 1) active @endif" aria-current="true" aria-label="Slide {{$loop->iteration}}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">

            @foreach($slide as $item)
                <div class="carousel-item @if($loop->iteration === 1) active @endif">
                    <img src="{{asset('/storage/' . $item['image'])}}" class="d-block w-100 "  alt="..." style="max-height: 800px;">
                </div>
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <div class="container">
        <div class="row g-5">
            <div class="col-xs-12 col-sm-7 col-md-8">
                <div class="card-body border-bottom">
                    <h1 class="display-6">{{$website[0]['title']}}</h1>
                </div>
                <div class="card-body g-5">

                    {!! $website[0]['description'] !!}


                    <div class="row">
                        <div class="col-md-4">
                            <a href="/about" class="btn btn-primary">Подробнее</a>
                        </div>

                        @if($website[0]['url_application'] === 1)
                            <div class="col-md-8 text-end">
                                <a href="">
                                    <img src="{{asset('image/appstore.png')}}" class="img-responsive imgStore" alt="">
                                </a>
                                <a href="">
                                    <img src="{{asset('image/googleplay.png')}}" class="img-responsive imgStore" alt="">
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-4 ">
                <div class="card-body border-bottom">
                    <h3 class="display-6" >Контакты</h3>
                </div>
                <div class="card-body g-5 text-body">
                    <p><i class="fas fa-user-circle"></i> {{$websiteContact[0]['name_company']}}</p>
                    <p><i class="fas fa-compass"></i> {{$websiteContact[0]['location']}}</p>
                    <p><i class="fas fa-map-marker"></i> {{$websiteContact[0]['address']}}</p>
                    <p><i class="fas fa-phone"></i> <a href="tel:{{$websiteContact[0]['phone']}}">{{$websiteContact[0]['phone']}}</a></p>
                    <p><i class="fas fa-envelope"></i> <a href="mailto:info@avada-media.com.ua">{{$websiteContact[0]['email']}}</a></p>
                </div>
            </div>
        </div>




        <div class="row col-12 col-sm-12 col-lg-12 col-md-12">
            @foreach($conditions as $item)



                <div class="col-sm-12  col-md-6 col-lg-4 card-body" >

                    <div class="card shadow-sm h-100 ">
                        <img src="{{asset('/storage/' . $item['image'])}}" class="bd-placeholder-img card-img-top" width="100%" height="225" />

                        <div class="card-body">
                            <h3>{{$item['title']}}</h3>
                            <p class="card-text">{!! $item['description'] !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
