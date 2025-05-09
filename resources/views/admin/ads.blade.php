@extends('layout.index')
@section('main')
    <div class="page-action">

        <a href="#"><p>Объявления</p></a>
        <a href="{{ route('category') }}"><p>Категории</p></a>
    </div>
    <div class="page-action">
        <a href="#" data-hystmodal="#createCities"><p>Добавить город</p></a>
        <a href="#" data-hystmodal="#createCategories"><p>Добавить категорию</p></a>
    </div>
    <h1>Все объявления</h1>
    <br>
    <div class="admin-table">
        @foreach ($ads as $ad)
            <div class="admin-table__item">
                <div class="admin-table__item-content">
                    <p>id</p>
                    <p>{{ $ad->id }}</p>
                </div>
                <div class="admin-table__item-content">
                    <p>Пользователь</p>
                    <p>{{ $ad->user->name }} {{ $ad->user->surname }}</p> <!-- Выводим имя и фамилию пользователя -->
                </div>
                <div class="admin-table__item-content">
                    <p>Название</p>
                    <p>{{ $ad->name }}</p>
                </div>
                <div class="admin-table__item-content">
                    <p>Цена</p>
                    <p>{{ $ad->price }}</p>
                </div>
                <div class="admin-table__item-content">
                    <p>Описание</p>
                    <p>{{ $ad->description }}</p>
                </div>
                <div class="admin-table__item-content">
                    <p>Город</p>
                    <p>{{ $ad->city->name }}</p> <!-- Выводим название города -->
                </div>
                <div class="admin-table__item-content">
                    <p>Категория</p>
                    <p>{{ $ad->category->name }}</p> <!-- Выводим название категории -->
                </div>
                <div class="admin-table__item-content">
                    <p>Статус</p>
                    <p>{{ $ad->status }}</p>
                </div>

                <div class="admin-table__item-action">
                    <a href="#" data-hystmodal="#updateAd" class="edit-ad" data-id="{{ $ad->id }}" data-name="{{ $ad->name }}" data-price="{{ $ad->price }}" data-description="{{ $ad->description }}" data-status="{{ $ad->status }}" data-category="{{ $ad->category->name }}" data-city="{{ $ad->city->name }}" data-url="{{ $ad->url }}">
                        <div class="admin-table__action-edit">
                            <div class="action-edit__ico"></div>
                        </div>
                    </a>
                    <form action="{{ route('ads.delete', $ad->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; padding: 0;">
                            <div class="admin-table__action-delete">
                                <div class="action-delete__ico"></div>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.edit-ad').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Получаем данные объявления из атрибутов data-*
                    const adId = this.getAttribute('data-id');
                    const adName = this.getAttribute('data-name');
                    const adPrice = this.getAttribute('data-price');
                    const adDescription = this.getAttribute('data-description');
                    const adStatus = this.getAttribute('data-status');
                    const adCityId = this.getAttribute('data-city'); // ID города
                    const adCategoryId = this.getAttribute('data-category'); // ID категории

                    // Устанавливаем значения полей ввода в модалке
                    document.getElementById('adName').value = adName;
                    document.getElementById('adPrice').value = adPrice;
                    document.getElementById('adDescription').value = adDescription;
                    document.getElementById('adStatus').value = adStatus;

                    // Настроим город
                    const citySelect = document.getElementById('adCity');
                    for (let option of citySelect.options) {
                        if (option.value == adCityId) {
                            option.selected = true;  // Выбираем город, который был выбран
                            break;
                        }
                    }

                    // Настроим категорию
                    const categorySelect = document.getElementById('adCategory');
                    for (let option of categorySelect.options) {
                        if (option.value == adCategoryId) {
                            option.selected = true;  // Выбираем категорию, которая была выбрана
                            break;
                        }
                    }

                    // Настроим действие формы на правильный маршрут для обновления объявления
                    const editForm = document.getElementById('editAdForm');
                    editForm.action = '/admin/ads/update/' + adId; // Путь для обновления объявления

                });
            });
        });


    </script>
@endsection
