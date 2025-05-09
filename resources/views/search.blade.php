@extends('layout.index')
@section('main')
    <h1>Результат поиска: {{ $request['search'] }}</h1>
    <br>
    <div class="grid-container">
        @if($ads->isEmpty())
            <p>Нет объявлений по запросу</p>
        @else
            @foreach($ads as $ad)
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
@endsection
