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
    @if (session('notyf'))
        <script>
            const notyf = new Notyf({
                duration: 3000,
                ripple: true
            });


            const notyfData = @json(session('notyf'));


            if (notyfData.type === 'success') {
                notyf.success(notyfData.message);
            } else if (notyfData.type === 'error') {
                notyf.error(notyfData.message);
            }
        </script>
    @endif


    <div class="sitebar">
        <div class="sitebar-logo">
            <a href="{{ route('home') }}">
                <div class="logo">
                    <p>Куоффер</p>
                </div>
            </a>
        </div>
        <div class="sitebar-action">

            @guest
                <div class="sitebar-action__unlogin">
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
            @endguest

            @auth

                <div class="sitebar-action__login">

                    <a href="@if(\Illuminate\Support\Facades\Auth::user()->role == 'admin') {{ route('admin') }} @elseif (\Illuminate\Support\Facades\Auth::user()->role == 'user') {{ route('account') }} @endif">
                        <div class="action-linkButton">
                            <p>Личный кабинет</p>
                        </div>
                    </a>

                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'user')
                        <a href="" data-hystmodal="#create">
                            <div class="action-linkButton">
                                <p>Разместить объявление</p>
                            </div>
                        </a>
                        <a href="{{route('fav.show')}}">
                            <div class="action-linkButton">
                                <p>Избранное</p>
                            </div>
                        </a>
                        <a href="" data-hystmodal="#accountSettings">
                            <div class="action-linkButton">
                                <p>Настройки</p>
                            </div>
                        </a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Выход</button>
                    </form>
                </div>
            @endauth

        </div>
        <div class="sitebar-search">
            <form action="{{ route('search') }}" method="get">
                <input type="text" name="search" placeholder="Поиск">
                <button type="submit">Найти</button>
            </form>
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
