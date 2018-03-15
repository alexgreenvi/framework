<div class="container-fluid">
    <div class="container">
        <?$this->app->template('admin','module_aside', '', $arParam)?>
        <div class="container-main">
            <div class="admin">
                <div class="admin__top">
                    <div class="admin__top__btn">
                        <a href="/admin/module/<?=$arParam['code']?>/element_add" title="" class="core__btn"><span>Добавить</span></a>
                    </div>
                    <div class="admin__top__title">
                        <h1><?=$arParam['name']?></h1>
                    </div>
                    <div class="admin__top__text">
                        Количесво материалов : <?=$arParam['count']?>
                    </div>
                </div>
                <?$this->app->component('list' , 'admin.module' , '', [
                    'module_code' => $arParam['code'],
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
            </div>
        </div>
    </div>
</div>