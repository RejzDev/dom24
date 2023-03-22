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

    <div class="card-body container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="" class="text-decoration-none">Главная</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Контакты</li>
            </ol>
        </nav>
    </div>


    <div class="container-fluid">
        {!! $website[0]['code_maps'] !!}
    </div>

    <div class="container">

        <div class="row g-5">
            <div class="col-xs-12 col-sm-7 col-md-8">
                <div class="card-body border-bottom">
                    <h1 class="display-6">{{$website[0]['title']}}</h1>
                </div>
                <div class="card-body g-5">

                    {!! $website[0]['description'] !!}


                </div>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-4 ">
                <div class="card-body border-bottom">
                    <h3 class="display-6" >Контакты</h3>
                </div>
                <div class="card-body g-5 text-body">
                    <p><i class="fas fa-user-circle"></i> {{$website[0]['name_company']}}</p>
                    <p><i class="fas fa-compass"></i> {{$website[0]['location']}}</p>
                    <p><i class="fas fa-map-marker"></i> {{$website[0]['address']}}</p>
                    <p><i class="fas fa-phone"></i> <a href="tel:{{$website[0]['phone']}}">{{$website[0]['phone']}}</a></p>
                    <p><i class="fas fa-envelope"></i> <a href="mailto:info@avada-media.com.ua">{{$website[0]['email']}}</a></p>
                </div>
            </div>
        </div>




    </div>
@endsection
