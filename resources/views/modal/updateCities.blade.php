<div class="hystmodal" id="updateCities" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div class="modal-container">
                <div class="modal-close" data-hystclose></div>
                <div class="modal-header">
                    <p>Редактирование города</p>
                </div>

                <form id="editCityForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" id="cityName" placeholder="Название города">
                    <input type="text" name="in_city" id="cityInCity" placeholder="Город в пределах">
                    <input type="text" name="url" id="cityUrl" placeholder="URL">
                    <button type="submit">Редактировать</button>
                </form>
            </div>
        </div>
    </div>
</div>
