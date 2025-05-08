<div class="hystmodal" id="updateCategories" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div class="modal-container">
                <div class="modal-close" data-hystclose></div>
                <div class="modal-header">
                    <p>Редактирование</p>
                </div>

                <form id="editCategoryForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" id="categoryName" placeholder="Название категории">
                    <input type="text" name="url" id="categoryLink" placeholder="Ссылка">
                    <input type="text" name="description" id="categoryDescription" placeholder="Описание">
                    <button type="submit">Редактировать</button>
                </form>

            </div>
        </div>
    </div>
</div>


