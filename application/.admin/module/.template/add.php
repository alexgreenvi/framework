<div class="admin__top">
    <div class="admin__top__title">
        <h1>Добавление материала</h1>
    </div>
    <div class="admin__top__text">
        Количесво материалов : <?=$arParam['module']['count']?>
    </div>
</div>
<?$this->app->ajax('edit', '/ajax/module/'.$arParam['page']['name'].'/', [
    'ajax-form-module-id' => $arParam['module']['id'], // id модуля
    'ajax-form-module-code' => $arParam['module']['code'], // code модуля
    'ajax-form-module-element-id' => '' // id элемента
])?>