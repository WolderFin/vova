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
                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'user')
                        <a href="" data-hystmodal="#create">
                            <div class="action-linkButton">
                                <p>Разместить объявление</p>
                            </div>
                        </a>
                        <a href="{{ route('account') }}">
                            <div class="action-linkButton">
                                <p>Мои объявления</p>
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
                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                        <a href="{{ route('admin') }}">
                            <div class="action-linkButton">
                                <p>Города</p>
                            </div>
                        </a>
                        <a href="{{ route('ads') }}">
                            <div class="action-linkButton">
                                <p>Объявления</p>
                            </div>
                        </a>
                        <a href="{{ route('category') }}">
                            <div class="action-linkButton">
                                <p>Категории</p>
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
        @guest()
            <div class="sitebar-search">
                <form action="{{ route('search') }}" method="get">
                    <input type="hidden" name="sort" value="">
                    <input type="text" name="search" placeholder="Поиск">
                    <button type="submit">Найти</button>
                </form>
            </div>
        @endguest
        @auth()
            @if(\Illuminate\Support\Facades\Auth::user()->role == 'user')
                <div class="sitebar-search">
                    <form action="{{ route('search') }}" method="get">
                        <input type="hidden" name="sort" value="">
                        <input type="text" name="search" placeholder="Поиск">
                        <button type="submit">Найти</button>
                    </form>
                </div>
            @endif
        @endauth
        @if(request()->routeIs('home') || request()->routeIs('search'))
            <div class="sitebar-filter">
                <form action="" method="get">
                    <select name="sort">
                        @if(!request()->get('sort')) <!-- Проверка наличия параметра sort -->
                        <option disabled selected>Выберите сортировку</option>
                        @endif
                        <option value="price_asc" @if(request()->get('sort') === 'price_asc') selected disabled @endif>По возрастанию цены</option>
                        <option value="price_desc" @if(request()->get('sort') === 'price_desc') selected disabled @endif>По убыванию цены</option>
                        <option value="date_asc" @if(request()->get('sort') === 'date_asc') selected disabled @endif>По дате публикации (старые вначале)</option>
                        <option value="date_desc" @if(request()->get('sort') === 'date_desc') selected disabled @endif>По дате публикации (свежие вначале)</option>
                    </select>

                    <!-- Добавляем другие GET параметры в URL -->
                    @foreach(request()->except('sort') as $key => $value)  <!-- Теперь используем request() -->
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <button type="submit">Применить</button>
                </form>
            </div>
        @endif

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
