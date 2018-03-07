
<div class="admin__user__login">
    <div class="admin__user__login__wrap">
        <div class="title">
            <h1>Вход в панель управления</h1>
        </div>
        <div class="form">
            <?$this->app->ajax('user-login', '/ajax/user/login/', [])?>
        </div>
    </div>
</div>

