<div class="hystmodal" id="createCategories" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div class="modal-container">
                <div class="modal-close" data-hystclose></div>
                <div class="modal-header">
                    <p>Добавить категорию</p>
                </div>

                <form id="editCityForm" action="{{ route('categories.create') }}" method="POST">
                    @csrf
                    <input type="text" name="name" id="categoryName" placeholder="Название категории">
                    <input type="text" name="url" id="categoryLink" placeholder="Ссылка">
                    <input type="text" name="description" id="categoryDescription" placeholder="Описание">
                    <button type="submit">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</div>
