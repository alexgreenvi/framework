<div class="admin__top">
    <div class="admin__top__title">
        <h1><?=$arParam['title']?></h1>
    </div>
    <div class="admin__top__text">
        Адрес материала - <a href="/<?=$arParam['table']?>/<?=$arResult['code']?>/" title="Перейти">/<?=$arParam['table']?>/<?=$arResult['code']?>/</a>
    </div>
</div>
<?$this->app->ajax('edit', '/ajax/module/'.$arParam['page']['name'].'/', [
    'ajax-form-table' => 'category',
    'ajax-form-table-to' => $arParam['tableTo'],
    'ajax-form-code' => $arResult['code'],
    'ajax-form-id' => $arResult['id']
])?>