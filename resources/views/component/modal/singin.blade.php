<div class="hystmodal" id="singin" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <div class="modal-container">
                <div class="modal-close" data-hystclose></div>
                <div class="modal-header">
                    <p>Вход</p>
                </div>
                <form>
                    <input type="tel" name="tel" id="singin-tel" placeholder="Номер телефона">
                    <input type="password" name="password" placeholder="Пароль">
                    <button type="submit">Войти</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    IMask(
        document.getElementById('singin-tel'),
        {
            mask: '+{7}(000)000-00-00'
        }
    )
</script>
