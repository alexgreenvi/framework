<div class="admin__top">
    <div class="admin__top__title">
        <h1><?=$arParam['title']?></h1>
    </div>
    <div class="admin__top__text">
        Количесво материалов : <?=$arParam['count']?>
    </div>
</div>
<?$this->app->ajax('edit', '/ajax/module/'.$arParam['page']['name'].'/', [
    'ajax-form-table' => $arParam['table'],
    'ajax-form-code' =>  '',
    'ajax-form-id' =>  ''
])?>