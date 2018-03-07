<div class="container-fluid">
    <div class="container">
        <?$this->app->template('admin','module_aside', '', $arParam)?>
        <div class="container-main">
            <div class="admin">
                <div class="admin__top">
                    <div class="admin__top__title">
                        <h1>Редактирование категории</h1>
                    </div>
                    <div class="admin__top__text">
                        Адрес категории - <a href="/<?=$arParam['code']?>/category/<?=$arResult['code']?>/" title="Перейти">/<?=$arParam['code']?>/category/<?=$arResult['code']?>/</a>
                    </div>
                </div>
                <?$this->app->ajax('category_edit', '/ajax/module/category_edit/', [
                    'ajax-form-module-id' => $arParam['id'], // id модуля
                    'ajax-form-module-code' => $arParam['code'], // code модуля
                    'ajax-form-module-element-id' => $arResult['id'] // id элемента
                ])?>
            </div>
        </div>
    </div>
</div>