<div class="admin__top">
    <div class="admin__top__title">
        <h1>Редактирование категории</h1>
    </div>
    <div class="admin__top__text">
        Адрес категории - <a href="/<?=$arParam['module']['code']?>/category/<?=$arResult['code']?>/" title="Перейти">/<?=$arParam['module']['code']?>/<?=$arResult['code']?>/</a>
    </div>
</div>
<?$this->app->ajax('edit', '/ajax/module/'.$arParam['page']['name'].'/', [
    'ajax-form-module-id' => $arParam['module']['id'], // id модуля
    'ajax-form-module-code' => $arParam['module']['code'], // code модуля
    'ajax-form-module-element-id' => $arParam['page']['id'], // id элемента
    'ajax-form-module-category' => $arParam['category'] // для категорий
])?>
