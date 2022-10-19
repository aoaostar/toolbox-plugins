<?php

namespace plugin\aoaostar_com\uuid;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = "UUID生成器";
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '花式生成UUID';
        $model->version = 'v1.1';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
