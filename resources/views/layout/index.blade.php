<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Куоффер</title>
    @include('extends.css')
</head>
<body>
<header>
    <div class="sitebar">
        <div class="sitebar-logo">
            <a href="{{ route('home') }}">
                <div class="logo">
                    <p>Куоффер</p>
                </div>
            </a>
        </div>
        <div class="sitebar-action">
            <div class="sitebar-action__unlogin" style="display: none">
                <a href="" data-hystmodal="#singin">
                    <div class="action-linkButton">
                        <p>Вход</p>
                    </div>
                </a>
                <a href="" data-hystmodal="#singup">
                    <div class="action-linkButton">
                        <p>Регистрация</p>
                    </div>
                </a>
            </div>
            <div class="sitebar-action__login">
                <a href="" data-hystmodal="#create">
                    <div class="action-linkButton">
                        <p>Разместить объявление</p>
                    </div>
                </a>
                <form action="#">
                    <button type="submit">Выход</button>
                </form>
            </div>
        </div>
        <div class="sitebar-search">
            <input type="text" name="search">
            <button type="submit">Найти</button>
        </div>
        <a href="#" data-hystmodal="#city">
            <div class="sitebar-city">
                <div class="sitebar-city__ico">
                </div>
                <div class="sitebar-city__content">
                    <p id="city-content"></p>
                </div>
            </div>
        </a>
    </div>
</header>
<main>
    <div class="container">
        @yield('main')
    </div>
</main>
<footer>
    <div class="footer-container">
        <div class="footer-item">
            <p>© {{ date('Y') }} «Куоффер»</p>
        </div>
        <div class="footer-item">
            <p>г. Курган, ул. Гвардейская 2б</p>
            <p>+7 922 675 68 19</p>
        </div>
    </div>
    @include('extends.js')
</footer>
</body>
</html>
