<?php

namespace plugin\aoaostar_com\timestamp;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = 'Unix时间戳';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = 'Unix时间戳和北京时间的互相转化';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
