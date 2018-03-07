<div class="container-fluid">
    <div class="container">
        <?$this->app->template('admin','module_aside', '', $arParam)?>
        <div class="container-main">
            <div class="admin">
                <div class="admin__top">
                    <div class="admin__top__title">
                        <h1>Настройки модуля</h1>
                    </div>
                    <div class="admin__top__text">
                        Адрес материала - <a href="/<?=$arParam['code']?>/" title="Перейти">/<?=$arParam['code']?>/</a>
                    </div>
                </div>
                <?$this->app->ajax('config', '/ajax/module/config/', [
                    'ajax-form-module-id' => $arParam['id'], // id модуля
                    'ajax-form-module-code' => $arParam['code'] // code модуля
                ])?>
            </div>
        </div>
    </div>
</div>