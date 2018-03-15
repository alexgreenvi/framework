<?
    $module_code = $this->uri->segment(3);
    $ID= $this->uri->segment(5);
    
    $arModule = $this->app->module_get_config($module_code);

    $this->db->delete('module_element',['id' => $ID,'module_id' => $arModule['id']]);
   // redirect(base_url().'admin/module/'.$arModule['code'].'/', 'refresh');
?>

<div class="container-fluid">
    <div class="container">
        <?$this->app->template('admin','module_aside', '', $arParam)?>
        <div class="container-main">
            <div class="admin">
                <div class="admin__top">
                    <div class="admin__top__title">
                        <h1>Материал был удален</h1>
                    </div>
                    <div class="admin__top__text">
                       <a href="/admin/module/<?=$arModule['code']?>/" class="bx-btn">Вернуться</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>