<div class="admin__top">
    <div class="admin__top__title">
        <h1>Настройки модуля</h1>
    </div>
    <div class="admin__top__text">
        Адрес материала - <a href="/<?=$arParam['module']['code']?>/" title="Перейти">/<?=$arParam['module']['code']?>//</a>
    </div>
</div>
<?$this->app->ajax('edit', '/ajax/module/'.$arParam['page']['name'].'/', [
    'ajax-form-module-id' => $arParam['module']['id'], // id модуля
    'ajax-form-module-code' => $arParam['module']['code'] // code модуля
])?>