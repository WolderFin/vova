@extends('layout.index')
@section('main')
    <div class="product-container">
        <div class="product-content">
            <div class="product-image">
                <img src="{{ '/storage/' . $ad->image }}" alt="">
                <div class="product-info">
                    <h1>{{ $ad->name }}</h1>
                    <h3>{{ $ad->price }} РУБ.</h3>
                </div>
            </div>
            @if(\Illuminate\Support\Facades\Auth::check())
                <div class="product-contacts">
                    <p>Телефон: {{ $ad->user->phone }}</p>
                    <p>Продавец: {{ $ad->user->name }}</p>
                </div>
            @else
                <div class="product-contacts">
                    <p>Войдите для просмотра информации продавца</p>
                </div>
            @endif
        </div>
        <div class="product-des">
            <h2>Описание</h2>
            <p>{{ $ad->description }} </p>
        </div>
        <br>
        <div class="Похожие">
            <h2>Похожие объявления</h2>
            <br>
            <div class="grid-container">
                @if($ad_similar->isEmpty())
                    <p>Пока нет доступных объявлений</p>
                @else
                    @foreach($ad_similar as $ad)
                        <a href="{{ route('ads.show', $ad->url) }}">
                            <div class="grid-item">
                                <div class="grid-item__img">
                                    <img src="{{ '/storage/' . $ad->image }}" alt="">
                                </div>
                                <div class="grid-item__content">
                                    <div class="grid-item__content-price">
                                        <p>{{$ad->name}}</p>
                                        <p>{{$ad->price}} РУБ.</p>
                                    </div>
                                    <div class="grid-item__content-city">
                                        <p>{{$ad->city->name}}, {{ $ad->created_at->format('d.m.Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
