<div class="hystmodal" id="updateAd" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div class="modal-container">
                <div class="modal-close" data-hystclose></div>
                <div class="modal-header">
                    <p>Редактирование объявления</p>
                </div>

                <div class="modal-body">
                    <p><strong>Название:</strong> <span id="adNameText"></span></p>
                    <p><strong>Цена:</strong> <span id="adPriceText"></span></p>
                    <p><strong>Описание:</strong> <span id="adDescriptionText"></span></p>
                    <p><strong>Город:</strong> <span id="adCityText"></span></p>
                    <p><strong>Категория:</strong> <span id="adCategoryText"></span></p>
                    <p><strong>URL:</strong> <span id="adUrlText"></span></p>

                    <!-- Статус объявления -->
                    <p><strong>Статус:</strong></p>
                    <select name="status" id="adStatus">
                        <option value="Размещено">Размещено</option>
                        <option value="Отклонено">Отклонено</option>
                        <option value="На модерации">На модерации</option>
                    </select>

                    <form id="editAdForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit">Обновить статус</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
