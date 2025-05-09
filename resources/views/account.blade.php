@extends('layout.index')
@section('main')
    <h1>Ваши объявления</h1> <br>
    <div class="grid-container">
        @if($ads->isEmpty())
            <p>Пока нет доступных объявлений</p>
        @else
            @foreach($ads as $ad)
                <!-- Проверяем статус объявления и делаем ссылку не кликабельной -->
                @if($ad->status == 'На модерации' || $ad->status == 'Отклонено')
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
                            <!-- Плашка с статусом -->
                            <div class="grid-item__status">
                            <span class="status-label {{ $ad->status == 'Активно' ? 'active' : ($ad->status == 'Продано' ? 'sold' : '') }}">
                                {{ $ad->status }}
                            </span>
                            </div>
                        </div>
                    </div>
                @else
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
                                <!-- Плашка с статусом -->
                                <div class="grid-item__status">
                                <span class="status-label {{ $ad->status == 'Активно' ? 'active' : ($ad->status == 'Продано' ? 'sold' : '') }}">
                                    {{ $ad->status }}
                                </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        @endif
    </div>


@endsection
