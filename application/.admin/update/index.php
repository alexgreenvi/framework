<div class="container-fluid">
    <div class="container">
        <aside class="container-aside">
            <div class="aside">
                <div class="aside__menu">
                    <ul class="aside__menu__list">
                        <li>
                            <a href="/admin/" title="Назад">
                                <i class="core__icon core__icon_arrow-large-left"></i>
                                Назад
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <div class="container-main">
            <div class="admin">
                <div class="admin__top">
                    <div class="admin__top__title">
                        <h1>Добавление Модуля</h1>
                    </div>
                    <div class="admin__top__text">

                    </div>
                </div>
                <?$this->app->ajax('module_add', '/ajax/module/module_add/', [])?>
            </div>
        </div>
    </div>
</div>