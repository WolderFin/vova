@extends('layout.index')
@section('main')
    <h1>Ваши объявления</h1> <br>
    <div class="grid-container">
        @if($ad_fav->isEmpty())
            <p>Пока нет доступных объявлений</p>
        @else
            @foreach($ad_fav as $item)
                <!-- Проверяем статус объявления и делаем ссылку не кликабельной -->
                @if($item->ad->status == 'На модерации' || $item->ad->status== 'Отклонено')
                    <div class="grid-item">
                        <div class="grid-item__img">
                            <img src="{{ '/storage/' . $item->ad->image }}" alt="">
                        </div>
                        <div class="grid-item__content">
                            <div class="grid-item__content-price">
                                <p>{{$item->ad->name}}</p>
                                <p>{{$item->ad->price}} РУБ.</p>
                            </div>
                            <div class="grid-item__content-city">
                                <p>{{$item->ad->city->name}}, {{ $item->ad->created_at->format('d.m.Y') }}</p>
                            </div>
                            <!-- Плашка с статусом -->
                            <div class="grid-item__status">
                            <span class="status-label {{ $item->ad->status == 'Активно' ? 'active' : ($item->ad->status == 'Продано' ? 'sold' : '') }}">
                                {{ $item->ad->status }}
                            </span>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('ads.show', $item->ad->url) }}">
                        <div class="grid-item">
                            <div class="grid-item__img">
                                <img src="{{ '/storage/' . $item->ad->image }}" alt="">
                            </div>
                            <div class="grid-item__content">
                                <div class="grid-item__content-price">
                                    <p>{{$item->ad->name}}</p>
                                    <p>{{$item->ad->price}} РУБ.</p>
                                </div>
                                <div class="grid-item__content-city">
                                    <p>{{$item->ad->city->name}}, {{ $item->ad->created_at->format('d.m.Y') }}</p>
                                </div>
                                <!-- Плашка с статусом -->
                                <div class="grid-item__status">
                                <span class="status-label {{ $item->ad->status == 'Активно' ? 'active' : ($item->ad->status == 'Продано' ? 'sold' : '') }}">
                                    {{ $item->ad->status }}
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
