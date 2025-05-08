<div class="hystmodal" id="singup" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div class="modal-container">
                <div class="modal-close" data-hystclose></div>
                <div class="modal-header">
                    <p>Регистрация</p>
                </div>
                <form>
                    <input type="text" name="name" placeholder="Имя">
                    <input type="text" name="firstname" placeholder="Фамилия">
                    <input type="tel" name="tel" id="singup-tel" placeholder="Номер телефона">
                    <input type="password" name="password" placeholder="Пароль">
                    <input type="password" name="repassword" placeholder="Пароль повтор">
                    <button type="submit">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    IMask(
        document.getElementById('singup-tel'),
        {
            mask: '+{7}(000)000-00-00'
        }
    )
</script>
