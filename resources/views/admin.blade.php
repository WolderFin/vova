@extends('layout.index')
@section('main')
    <div class="page-action">

        <a href="{{ route('ads') }}"><p>Объявления</p></a>
        <a href="{{ route('category') }}"><p>Категории</p></a>
    </div>
    <div class="page-action">
        <a href="#" data-hystmodal="#createCities"><p>Добавить город</p></a>
        <a href="#" data-hystmodal="#createCategories"><p>Добавить категорию</p></a>
    </div>
    <h1>Все города</h1>
    <br>
    <div class="admin-table">
        @foreach ($cities as $city)
            <div class="admin-table__item">
                <div class="admin-table__item-content">
                    <p>id</p>
                    <p>{{ $city->id }}</p>
                </div>
                <div class="admin-table__item-content">
                    <p>Название города</p>
                    <p>{{ $city->name }}</p>
                </div>
                <div class="admin-table__item-content">
                    <p>Город в пределах</p>
                    <p>{{ $city->in_city }}</p>
                </div>
                <div class="admin-table__item-content">
                    <p>URL</p>
                    <p>{{ $city->url }}</p>
                </div>

                <div class="admin-table__item-action">
                    <a href="#" class="edit-city" data-id="{{ $city->id }}" data-name="{{ $city->name }}" data-in_city="{{ $city->in_city }}" data-url="{{ $city->url }}" data-hystmodal="#updateCities">
                        <div class="admin-table__action-edit">
                            <div class="action-edit__ico"></div>
                        </div>
                    </a>
                    <form action="{{ route('cities.delete', $city->id) }}" method="POST" style="display: inline-block;">
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
        // Обработчик клика по кнопке редактирования
        document.querySelectorAll('.edit-city').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const cityId = this.getAttribute('data-id');
                const cityName = this.getAttribute('data-name');
                const cityInCity = this.getAttribute('data-in_city');
                const cityUrl = this.getAttribute('data-url');

                document.getElementById('cityName').value = cityName;
                document.getElementById('cityInCity').value = cityInCity;
                document.getElementById('cityUrl').value = cityUrl;

                const editForm = document.getElementById('editCityForm');
                editForm.action = '/cities/' + cityId; // Путь для обновления города

                HystModal.open('#updateCities');
            });
        });
    </script>

@endsection
