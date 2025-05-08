<div class="hystmodal" id="createCities" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div class="modal-container">
                <div class="modal-close" data-hystclose></div>
                <div class="modal-header">
                    <p>Добавить город</p>
                </div>

                <form id="createCityForm" action="{{ route('cities.create') }}" method="POST">
                    @csrf
                    <input type="text" name="name" id="cityName" placeholder="Название города">
                    <input type="text" name="in_city" id="cityInCity" placeholder="Город в пределах">
                    <input type="text" name="url" id="cityUrl" placeholder="URL">
                    <button type="submit">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</div>
