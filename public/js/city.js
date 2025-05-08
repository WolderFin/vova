function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function getCookie(name) {
    const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return match ? decodeURIComponent(match[2]) : null;
}

document.querySelectorAll('.modal-city__list a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const city = this.getAttribute('data-city');
        setCookie('selectedCity', city, 30);
        document.getElementById('city-content').textContent = city;

        // Закрываем модалку
        if (typeof Modal !== 'undefined' && Modal.close) {
            Modal.close("#city");
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const savedCity = getCookie('selectedCity');
    document.getElementById('city-content').textContent = savedCity || 'Россия';
});
