@extends('layout.index')
@section('main')
    <div class="page-action">
        <a href="#" data-hystmodal="#createCategories"><p>Добавить категорию</p></a>
    </div>
    <h1>Все категории</h1>
    <br>
    <div class="admin-table">
        <div class="admin-table">
            @foreach ($categories as $category)
                <div class="admin-table__item">
                    <div class="admin-table__item-content">
                        <p>id</p>
                        <p>{{ $category->id }}</p>
                    </div>
                    <div class="admin-table__item-content">
                        <p>Название</p>
                        <p>{{ $category->name }}</p>
                    </div>
                    <div class="admin-table__item-content">
                        <p>URL</p>
                        <p>{{ $category->url }}</p>
                    </div>
                    <div class="admin-table__item-content">
                        <p>Описание</p>
                        <p>{{ $category->description }}</p>
                    </div>
                    <div class="admin-table__item-action">
                        <a href="#" data-hystmodal="#updateCategories" class="edit-category" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-url="{{ $category->url }}" data-description="{{ $category->description }}">
                            <div class="admin-table__action-edit">
                                <div class="action-edit__ico"></div>
                            </div>
                        </a>
                        <form action="{{ route('categories.delete', $category->id) }}" method="POST" style="display: inline-block;">
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
    </div>
    <script>
        // Обработчик клика по кнопке редактирования категории
        document.querySelectorAll('.edit-category').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                // Получаем данные категории из атрибутов
                const categoryId = this.getAttribute('data-id');
                const categoryName = this.getAttribute('data-name');
                const categoryUrl = this.getAttribute('data-url');
                const categoryDescription = this.getAttribute('data-description');

                // Устанавливаем значения полей ввода в модалке
                document.getElementById('categoryName').value = categoryName;
                document.getElementById('categoryLink').value = categoryUrl;
                document.getElementById('categoryDescription').value = categoryDescription;

                // Настроим действие формы на правильный маршрут для обновления категории
                const editForm = document.getElementById('editCategoryForm');
                editForm.action = '/admin/categories/update/' + categoryId; // Путь для обновления категории

                // Открываем модалку
                HystModal.open('#updateCategories');
            });
        });
    </script>




@endsection
