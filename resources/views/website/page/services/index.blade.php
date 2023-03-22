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


    <div class="container">
        <div class="row g-5">
            <div class="col-12 col-sm-12 col-md-12">
                <div class="card-body border-bottom">
                    <h1 class="display-6">Услуги</h1>
                </div>


                    @foreach($websiteServices as $services)

                    <div class="row card-body">
                        <div class="col-sm-12 col-md-12 col-lg-7">
                            <img src="{{asset('/storage/' . $services['image'])}}" class="img-thumbnail" style="height: 300px; width: 100%" alt="">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-5">
                            <div class="card-body border-bottom">
                                <h3 class="display-6">Обслуживание паркинга</h3>
                            </div>
                            <p>

                                Жилой комплекс&nbsp; имеет собственный четырехуровневый надземный паркинг, обслуживание которого осуществляет управляющая компания.<br>Обслуживание паркинга включает в себя следующие работы и услуги: Уборка территории, &nbsp;Поддержание функционирования инженерных сетей паркинга, &nbsp;Обслуживание системы выезда-въезда в паркинг,  Обеспечение функционирования пропускного режима для въезда на территорию паркинга, &nbsp;Охрана и обеспечение безопасности жильцов и автомобильного транспорта.

                                <br>
                            </p>
                        </div>
                    </div>


                    @endforeach

                {{ $websiteServices->links('pagination::bootstrap-4')}}

                </div>
            </div>

        </div>




        <div class="row col-12 col-sm-12 col-lg-12 col-md-12">


        </div>
    </div>
@endsection
