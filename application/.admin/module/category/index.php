<div class="container-fluid">
    <div class="container">
        <?$this->app->template('admin','module_aside', '', $arParam)?>
        <div class="container-main">
            <div class="admin">
                <div class="admin__top">
                    <div class="admin__top__btn">
                        <a href="/admin/module/<?=$arParam['code']?>/category_add/" title="" class="core__btn"><span>Добавить</span></a>
                    </div>
                    <div class="admin__top__title">
                        <h1>Категории</h1>
                    </div>
                    <div class="admin__top__text">
                        Количесво материалов : <?=$arParam['count']?>
                    </div>
                </div>
                <?$this->app->component('list' , 'admin.module' , '', [
                    'module' => $arParam['code'],
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
            </div>
        </div>
    </div>
</div>