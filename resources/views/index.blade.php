@extends('layout.index')
@section('main')
    <div class="page-action category">
        @foreach($globalCategory as $category)
            <a href="?category={{$category->url}}"><p>{{$category->name}}</p></a>
        @endforeach
        <a href="{{route('home')}}"><p>Сбросить фильтр</p></a>
    </div>
    <div class="page-action">
        <h1 id="indexPage-title">Все объявления</h1>
    </div>
    <div class="grid-container">
        @if($ads->isEmpty())
            <p>Пока нет доступных объявлений</p>
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
    <script>
        const categoryList = new Map([
                @foreach($globalCategory as $category)
            ['{{$category->url}}', '{{$category->name}}'],
            @endforeach
        ])
        const cities = new Map([
                @foreach($globalCity as $city)
            ['{{$city->name}}', '{{$city->in_city}}'],
            @endforeach
        ])

        // Функция для получения значения из URL параметра
        function getQueryParam(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Функция для получения значения куки
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        // Основная логика
        window.addEventListener('DOMContentLoaded', function () {
            // Получаем категорию из GET-запроса (имя категории)
            const category = getQueryParam('category');  // Например, "phone"

            // Получаем город из куки
            const city = cities.get(getCookie('selectedCity'));

            // Определяем название
            let title = category ? categoryList.get(category) : "Все объявления";  // Если категория не указана, показываем "Все объявления"

            // Добавляем город, если он есть
            if (city) {
                title = `${title} ${city}`;
            } else {
                title = `${title} в России`;
            }

            // Устанавливаем новый заголовок
            document.getElementById('indexPage-title').textContent = title;
        });
    </script>
@endsection
