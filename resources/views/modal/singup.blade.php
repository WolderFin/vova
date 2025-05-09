<div class="hystmodal" id="singup" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div class="modal-container">
                <div class="modal-close" data-hystclose></div>
                <div class="modal-header">
                    <p>Регистрация</p>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Имя">
                    <input type="text" name="firstname" placeholder="Фамилия">
                    <input type="tel" name="tel" id="singup-tel" placeholder="Номер телефона">
                    <input type="password" name="password" placeholder="Пароль" min="6">
                    <input type="password" name="password_confirmation" placeholder="Повторите пароль" min="6">
                    <button type="submit">Зарегистрироваться</button>
                </form>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    IMask(
        document.getElementById('singup-tel'),
        {
            mask: '+{7}(000) 000-00-00'
        }
    )
</script>
