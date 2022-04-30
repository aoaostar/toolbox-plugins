<?php

namespace plugin\aoaostar_com\bandwidth_waste;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '让流量消失';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '以浪费的形式消耗你的流量';
        $model->version = 'v1.2';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
