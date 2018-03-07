<div class="container-fluid">
    <div class="container">
        <?$this->app->template('admin','module_aside', '', $arParam)?>
        <div class="container-main">
            <div class="admin">
                <div class="admin__top">
                    <div class="admin__top__title">
                        <h1>Добавление категории</h1>
                    </div>
                    <div class="admin__top__text">
                        Количесво материалов : <?=$arParam['count']?>
                    </div>
                </div>
                <?$this->app->ajax('category_add', '/ajax/module/category_add/', [
                    'ajax-form-module-id' => $arParam['id'], // id модуля
                    'ajax-form-module-code' => $arParam['code'], // code модуля
                    'ajax-form-module-element-id' => '' // id элемента
                ])?>
            </div>
        </div>
    </div>
</div>