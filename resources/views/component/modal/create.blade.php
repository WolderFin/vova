<div class="hystmodal" id="create" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div class="modal-container">
                <div class="modal-close" data-hystclose></div>
                <div class="modal-header">
                    <p>Разместить объявление</p>
                </div>
                <form>
                    <input type="text" name="name" placeholder="Название объявления">
                    <select>
                        <option disabled selected>Выберите город</option>
                        <option>sadasdas</option>
                        <option>sadasdas</option>
                        <option>sadasdas</option>
                    </select>
                    <label for="photo" class="photo-label">Загрузить фото</label>
                    <input type="file" name="photo" id="photo" class="photo-input">
                    <input type="text" name="description" placeholder="Описания объявления">
                    <select>
                        <option disabled selected>Выберите категорию</option>
                        <option>sadasdas</option>
                        <option>sadasdas</option>
                        <option>sadasdas</option>
                    </select>
                    <input type="text" name="price" id="create-price" placeholder="Цена">
                    <button type="submit">Создать</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    IMask(
        document.getElementById('create-price'),
        {
            mask: Number,
            min: 0,
            thousandsSeparator: ' '
        }
    )
</script>
