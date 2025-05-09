<div class="hystmodal" id="accountSettings" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div class="modal-container">
                <div class="modal-close" data-hystclose></div>
                <div class="modal-header">
                    <p>Настройки аккаунта</p>
                </div>
                <!-- Форма для редактирования информации о пользователе -->
                <form action="{{ route('accountUpdate', Auth::user()->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Имя -->
                    <input type="text" name="name" placeholder="Имя" value="{{ Auth::user()->name }}" required>

                    <!-- Фамилия -->
                    <input type="text" name="surname" placeholder="Фамилия" value="{{ Auth::user()->surname }}" required>

                    <!-- Телефон -->
                    <input type="tel" name="tel" id="singup-tel" placeholder="Номер телефона" value="{{ Auth::user()->phone }}" required>

                    <!-- Новый пароль -->
                    <input type="password" name="password" placeholder="Введите новый пароль" min="6">

                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </form>

            </div>
        </div>
    </div>
</div>
