<?php

namespace plugin\aoaostar_com\hex_convert;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '进制转化';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '支持在2~36进制之间进行任意转换';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
