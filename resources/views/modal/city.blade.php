<div class="hystmodal" id="city" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div class="modal-container">
                <div class="modal-close" data-hystclose></div>
                <div class="modal-header">
                    <p>Выберите город</p>
                </div>
                <div class="modal-city__list" id="cities-list">
                    @foreach($globalCity as $city)
                        <a href="#" data-city="{{$city->name}}"><p>{{$city->name}}</p></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Делегирование события для клика по ссылке города
    document.getElementById('cities-list').addEventListener('click', function(e) {
        // Проверяем, что клик был по <a> или его внутренним элементам
        if (e.target && e.target.closest('a')) {
            const city = e.target.closest('a').getAttribute('data-city');
            setCookie('selectedCity', city, 30);
            document.getElementById('city-content').textContent = city;

            // Закрываем модалку
            if (typeof Modal !== 'undefined' && Modal.close) {
                Modal.close("#city");
                location.reload();
            }
        }
    });

    // Функции для работы с куки
    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + encodeURIComponent(value) + expires + "; path=/";
    }

    function getCookie(name) {
        const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? decodeURIComponent(match[2]) : null;
    }

    // Проверка куки на сохраненный город при загрузке страницы
    document.addEventListener('DOMContentLoaded', function() {
        const savedCity = getCookie('selectedCity');
        document.getElementById('city-content').textContent = savedCity || 'Россия';
    });
</script>
