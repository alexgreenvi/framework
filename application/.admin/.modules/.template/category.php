<div class="admin__top">
    <div class="admin__top__btn">
        <a href="/admin/<?=$arParam['module']['code']?>/category/add" title="" class="core__btn"><span>Добавить</span></a>
    </div>
    <div class="admin__top__title">
        <h1>Категории</h1>
    </div>
    <div class="admin__top__text">
        Количесво материалов : <?=$arParam['module']['count']?>
    </div>
</div>
<?$this->app->component('list' , 'admin.module' , '', [
    'module' => $arParam['module']['code'],
    'type' => 'category',
    'table' => [
        'name' => [
            'name'=> 'Название',
            'category' => false
        ],
        'count'=> [
            'name'=> 'Материалы',
        ],
        'id'=> [
            'name'=> 'ID',
        ]
    ]
])?>
