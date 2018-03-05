<div class="admin__top">
    <div class="admin__top__btn">
        <a href="/admin/<?=$arParam['module']['code']?>/add" title="" class="core__btn"><span>Добавить</span></a>
    </div>
    <div class="admin__top__title">
        <h1><?=$arParam['module']['name']?></h1>
    </div>
    <div class="admin__top__text">
        Количесво материалов : <?=$arParam['module']['count']?>
    </div>
</div>
<?$this->app->component('list' , 'admin.module' , '', [
    'module' => $arParam['module']['code'],
    'type' => '',
    'table' => [
        'name' => [
            'name'=> 'Название',
            'cat' => true
        ],
        'date'=> [
            'name'=> 'Дата и время',
        ],
        'id'=> [
            'name'=> 'ID',
        ]
    ]
])?>