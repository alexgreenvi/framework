<div class="admin__top">
    <div class="admin__top__btn">
        <a href="/admin/<?=$arParam['table']?>/category/add" title="" class="core__btn"><span>Добавить</span></a>
    </div>
    <div class="admin__top__title">
        <h1><?=$arParam['title']?></h1>
    </div>
    <div class="admin__top__text">
        Количесво материалов : <?=$arParam['count']?>
    </div>
</div>
<?$this->app->component('list' , 'admin.module' , '', [
    'from' => 'category',
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